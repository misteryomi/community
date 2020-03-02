<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $user;

    function __construct(User $user) {

        $this->middleware(function($request, $next) {
            $this->user = $request->user();

            return $next($request);
        });
    }

    public function index(User $user) {
        $posts = $user->posts()->latest()->paginate(15);

        return view('profile.show', compact('user', 'posts'));
    }


    public function savedTopics() {
        $user = $this->user;
        $posts = $this->user->bookmarkedTopics()->latest()->paginate(15);

        return view('profile.show', compact('user', 'posts'));
    }


    public function settings() {
        $user = Auth::user();

        return view('profile.settings', compact('user'));
    }

    public function update(Request $request) {
        $user = Auth::user();

        $request->validate([
            'avatar' => 'image'
        ]);

        $requestData = $request->all();
        if($request->has('avatar')) {
            $path = $request->avatar->store('avatars');

            $requestData['avatar']  = env('APP_URL').'storage/'.$path;
        } else {
            $requestData['avatar'] = $user->details->avatar;
        }

        \App\UserDetails::updateOrCreate(['user_id' => $user->id], $requestData);

        return redirect(route('profile.settings'))->withMessage('Profile updated successfully!');
    }


    public function feedSettings(Request $request) {
        $request->validate([
            'feed_type' => 'required'
        ]);

        $request->user()->settings()->updateOrCreate($request->except('_token'));

        return redirect(route('profile.settings'))->withMessage('Feed Settings updated successfully!');

    }

    public function apiList(Request $request) {
        $users = $this->user->where('username', 'like', "%$request->username%")->get();

        $users = $users->map(function ($user) {
            return [
                'id' => $user->username,
                'userId' => $user->id,
                'name' => $user->fullname ? $user->fullname : $this->username,
                'link' => 'http://google.com'
            ];
        });

        return $users->toJson();
    }

}
