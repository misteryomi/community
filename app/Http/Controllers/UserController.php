<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;

class UserController extends Controller
{
    private $user;

    function __construct(User $user) {
        $this->user = $user;
    }

    public function index(User $user) {
        $posts = $user->posts()->latest()->paginate(15);

        return view('profile.show', compact('user', 'posts'));
    }

    public function apiList(Request $request) {
        $users = $this->user->where('username', 'like', "%$request->username%")->get();

        $users = $users->map(function ($user) {
            return [
                'id' => $user->username,
                'userId' => $user->id,
                'name' => '$user->fullname',
                'link' => 'http://google.com'
            ];
        });

        return $users->toJson();
    }

}
