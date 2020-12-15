<?php

namespace App\Http\Controllers;

use App\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Jenssegers\Agent\Agent;


class CommunityController extends Controller
{
    private $community;
    private $user;
    private $agent;

    function __construct(Community $community) {
        $this->community = $community->where('is_active', true);
        $this->agent = new Agent();


        $this->middleware(function($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     * Display feed of posts in specified category
     * @return response
     */
    public function list(Community $community) {
        $agent = $this->agent;

        $posts = $community->posts()->latest()->paginate(30);

        return view('posts.list', compact('community', 'posts', 'agent'));
    }

    public function all(Request $request) {

        if($request->has('q')) {
            $communities = $this->community->where('name', 'LIKE', "%$request->q%")->paginate(45);
        } else {
            $communities = $this->community->paginate(45);
        }

        return view('community.list', compact('communities'));
    }

    public function joined() {

        $user = $this->user;

        $communities = $this->community->whereHas('followers', function($query) use ($user) {
                            return $query->where('user_id', $user->id);
                        })->paginate(15);
        
        return view('community.list', compact('communities'));
    }

    public function userCommunities(User $user) {

        $communities = $this->community->where('user_id', $user->id)->paginate(15);
        
        return view('community.list', compact('communities'));
    }


    public function follow(Community $community) {

        $community->followers()->create(['user_id' => $this->user->id]);

        return redirect()->back()->withMessage('You are now following '. $community->name .'!');
    }

    public function unfollow(Community $community) {
        $community->followers()->where('user_id', $this->user->id)->delete();

        return redirect()->back()->withMessage('You have successfully unfollowed '. $community->name .'!');
    }

    public function new() {
        $communities = $this->community->take(10)->get();

    

        return view('community.new', compact('communities'));
    }

    
    public function APISearch(Request $request) {

        $communities = $this->community->selectRaw('id, parent_id, name as text')->where('name', 'LIKE', "%$request->term%");

        if($request->has('parent_id')) {
            $communities = $communities->where('parent_id', $request->parent_id);

//            dd($communities->get(), $request->all());
        }
        

        $communities = $communities->take(15)->get();


        return response(['results' => $communities]);
    }

}
