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

    public function apiList() {
        return $this->user->select('username')->get()->pluck('username')->toJson();
    }

}
