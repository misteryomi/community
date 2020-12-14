<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function __invoke() {

        $stats = new \stdClass();
        $posts = new \App\Post;

        $stats->topics = $posts->getPostsType('topics')->count();
        $stats->jobs = $posts->getPostsType('jobs')->count();
        $stats->questions = $posts->getPostsType('questions')->count();
        $stats->rants = $posts->getPostsType('rants')->count();
        
        return view('admin.index', compact('stats'));
    }


}
