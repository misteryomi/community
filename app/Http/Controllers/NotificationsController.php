<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    private $notification;
    private $user;

    function __construct(Notification $notification)
    {
        $this->notification = $notification;

        $this->middleware(function($request, $next) {
            $this->user = Auth::user();


            return $next($request);
        });
    }


    public function index() {

        $notifications = $this->user->notifications()->latest()->paginate(15);

        return view('notifications.list', compact('notifications'));
    }
}
