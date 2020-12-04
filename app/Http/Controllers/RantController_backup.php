<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\RantResource;
use App\Http\Resources\RantsListCollection;
use App\Rant;
use App\User;
use App\Mood;
use App\RantCategory;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Traits\ContentTrait;

use \Carbon\Carbon;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\Routing\Route;

class RantControllerBackup extends Controller
{
    use SEOTrait, ContentTrait;

    private $rant;
    private $mood;
    private $user;
    private $agent;

    private static $PAGINATION_LIMIT = 20;

    function __construct(Rant $rant, RantCategory $category, Mood $mood) {
        $this->rant = $rant;
        $this->mood = $mood;
        $this->category = $category;
        $this->agent = new Agent();

        $this->middleware(function($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });

    }


    /**
     * Display feed of {featured} rants
     * @return response
     */
    public function index(Request $request) {
        $agent = $this->agent;


        if($this->user && $this->user->settings && $this->user->settings->feed_type == 'communities') {
            $rants = $this->user->communitiesTopics()->latest()->paginate(SELF::$PAGINATION_LIMIT);
        } else {
            $rants = $this->rant->where('is_featured', 1)->take('30')->latest()->paginate(SELF::$PAGINATION_LIMIT);
        }

        $communities = \App\Mood::where('is_parent', true)->get(); //->ordered();
        
        $isHomepage = true;

        if($request->feed_type && $this->user) {
            $this->user->settings()->updateOrCreate(['user_id' => $this->user->id], ['feed_type' => $request->feed_type]);
            return redirect()->route('home');
        }

        $trending = $this->getTrending()->take(7)->get();

        return view('welcome', compact('rants', 'communities', 'isHomepage', 'agent', 'trending'));
    }


    /**
     * Display feed of all rants
     * @return response
     */
    public function all(Request $request) {
        $agent = $this->agent;

        $rants = $this->rant->latest();
        
        if($request->has('q')) {
           $rants =  $rants->where('title', 'like', '%'.$request->q.'%')->orWhere('details', 'like', '%'.$request->q.'%');
        }
        
        $rants =  $rants->paginate(SELF::$PAGINATION_LIMIT);

        $communities = $this->mood->where('is_featured', true)->get();

        return view('rants.list', compact('rants', 'communities', 'agent'));
    }


    public function latest(Request $request) {
        $agent = $this->agent;

        $rants = $this->rant->latest();
        
        $rants =  $rants->paginate(SELF::$PAGINATION_LIMIT);

        $communities = $this->mood->where('is_featured', true)->get();

        $title = 'Latest Topics';

        return view('rants.list', compact('rants', 'communities', 'title', 'agent'));
    }    

    public function trending(Request $request) {
        $agent = $this->agent;

        $rants = $this->getTrending();
        
        $rants =  $rants->paginate(SELF::$PAGINATION_LIMIT);

        $communities = $this->mood->where('is_featured', true)->get();

        $title = 'Trending Topics';

        return view('rants.list', compact('rants', 'communities', 'title', 'agent'));
    }    


    private function getTrending() {
       $trending =  $this->rant->withCount('views')->whereBetween('created_at', [Carbon::now()->subDays(7), now()])->orderBy('views_count', 'DESC');

       if(!$trending->count()) {
            $trending =  $this->rant->withCount('views')->orderBy('views_count', 'DESC');
       }

       return $trending;
    }
    /**
     * Display rant
     * @param $rant_id rant_id of the rant
     * @return response
     */
    public function show(Request $request, Rant $rant) {
        $comments = $rant->comments()->paginate(SELF::$PAGINATION_LIMIT);

        $session_id =  $request->getSession()->getId();

        $guestHasViewed = !$this->user && $rant->views()->where('session_id', $session_id)->first();

        $loggedInUserHasViewed = $this->user && $rant->views()->where('user_id', $this->user->id)->first();

        $hasViewed = $this->user ? $loggedInUserHasViewed : $guestHasViewed;

        if(!$hasViewed) {
            $rant->views()->create([
                'session_id' => $session_id,
                'ip' => $request->getClientIp(),
                'agent' => $request->header('User-Agent'),
                'user_id' => $this->user ? $this->user->id : null,
                'created_at' => now(),
            ]);
        }

        $this->setSEO($rant->title, $rant->excerpt, route('rants.show', ['rant' => $rant->slug]));

        $related = $this->rant->relatedTopics($rant)->take(8)->get();

        return view('rants.show', compact('rant', 'comments', 'related'));
    }



    /**
     * Create new Rant
     * @return view
     */
    public function new($mood = null) {

        $category = $this->mood->where('slug', $mood)->first();

        if(!$category) {
            $categories = $this->category->ordered(); //->where('is_parent', true)->
        } else {
            $categories = $this->category->where('parent_id', $category->id)->ordered();
        }

        return view('rants.new', compact('categories', 'category'));
    }



    /**
     * Create a new rant
     * @param $request
     * @return response
     */
    public function store(Request $request) {

    
        $requestData = $request->all();
        $validation =  Validator::make($requestData, [
                        'title' => 'required|max:255',
                        'details' => 'required',
                        'mood_id' => 'required'
                        // 'photo' => 'mimestypes:image/jpeg,image/bmp,image/png,video/avi,video/mpeg,video/quicktime',
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }


    

        $newID = $this->rant->count() + 1;
        $requestData['slug'] = \Str::slug($requestData['title'], '-').'-'.$newID;
        $rant = $this->user->rants()->create($requestData);

        //Notify all mentions
        $mentions = $this->fetchMentions($request->details);

        if(count($mentions) > 0) {
            $this->notifyMentions($rant, $mentions);
        }


        return redirect()->route('rants.show', ['rant' => $rant->slug]);

    }


    /**
     * Modify Rant
     * @return view
     */
    public function edit(Rant $rant) {

        if(!$this->user->canEditRant($rant)) {
            abort(404);
        }
                //only owner or moderator can edit

        $moods = $this->mood->where('is_parent', true)->ordered();

        return view('rants.new', compact('rant', 'moods'))->withIsEdit(true);
    }


    /**
     * Update Modified Rant
     * @return response
     */
    public function update(Request $request, Rant $rant) {
        if(!$this->user->canEditRant($rant)) {
            abort(404);
        }

        //only owner or moderator can edit

        $requestData = $request->all();
        $validation =  Validator::make($requestData, [
                        'title' => 'required|max:255',
                        'details' => 'required'
                        // 'photo' => 'mimestypes:image/jpeg,image/bmp,image/png,video/avi,video/mpeg,video/quicktime',
        ]);

        if($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors())->withInput();
        }

        $rant->update($requestData);

      

        return redirect()->route('rants.show', ['rant' => $rant->slug]);
    }

    
    public function delete(Rant $rant) {
        $rant->delete();

        return redirect()->route('profile.show', ['user' => $this->user->username])->withMessage('Topic deleted successfully!');

    }

    public function like(Rant $rant) {

        $rant->likes()->firstOrCreate(['user_id' => $this->user->id], ['created_at' => now()]);

        return response(['status' => true]);
    }

    public function unlike(Rant $rant) {

        $rant->likes()->where('user_id', $this->user->id)->delete();

        return response(['status' => true]);
    }


    public function bookmark(Rant $rant) {

        $rant->bookmarks()->firstOrCreate(['user_id' => $this->user->id], ['created_at' => now()]);

        return response(['status' => true]);
    }

    public function removeBookmark(Rant $rant) {

        $rant->bookmarks()->where('user_id', $this->user->id)->delete();

        return response(['status' => true]);
    }


}
