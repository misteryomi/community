<?php

namespace App\Http\Controllers;

use App\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Jenssegers\Agent\Agent;


class MoodController extends Controller
{
    private $mood;
    private $user;
    private $agent;

    function __construct(Mood $mood) {
        $this->mood = $mood->where('is_active', true);
        $this->agent = new Agent();


        $this->middleware(function($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     * Display feed of posts in specified mood
     * @return response
     */
    public function list(Mood $mood) {
        $agent = $this->agent;

        $posts = $mood->posts()->latest()->paginate(15);

        return view('posts.list', compact('mood', 'posts', 'agent'));
    }

    public function all() {
        $moods = $this->mood->paginate(15);

        return view('mood.list', compact('moods'));
    }


    public function new() {
        return view('mood.new');
    }

    
    public function APISearch(Request $request) {
        $moods = $this->mood->selectRaw('id, name as text')->where('name', 'LIKE', "%$request->term%")->take(15)->get();

        return response(['results' => $moods]);
    }

}
