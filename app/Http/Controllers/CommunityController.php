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

        $posts = $community->posts()->latest()->paginate(15);

        return view('posts.list', compact('community', 'posts', 'agent'));
    }

    public function all() {
        $communities = $this->community->paginate(15);

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
        return view('community.new');
    }


}
