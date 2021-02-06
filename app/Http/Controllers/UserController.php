<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $user;
    private $agent;

    function __construct(User $user) {

        
        $this->middleware(function($request, $next) {
            $this->user = $request->user();
            $this->agent = new Agent();

            return $next($request);
        });
    }

    public function index(Request $request, User $user) {

        //Check if $user is not empty, but is logged in
        // if(!$user->id && auth()->user()) {
        //     $user = auth()->user();
        // } else {
        //     return redirect()->route('login');
        // }
        
        
        if($request->has('type')) {
            $posts = (new Post)->getPostsType($request->type)->latest()->paginate(15);
        } else {
            $posts = $user->posts()->latest()->paginate(15);
        }

        $agent = $this->agent;

        return view('profile.show', compact('user', 'posts', 'agent'));
    }


    public function settings() {
        $user = Auth::user();

        return view('profile.settings', compact('user'));
    }


    public function profilePicture() {
        $user = Auth::user();

        return view('profile.profile-picture', compact('user'));
    }

    public function feedSettings() {
        $user = Auth::user();

        return view('profile.feed', compact('user'));
    }

    public function password() {
        $user = Auth::user();

        return view('profile.password', compact('user'));
    }


    public function deactivate() {
        $user = Auth::user();

        return view('profile.deactivate', compact('user'));
    }


    public function update(Request $request) {


        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required'
        ]);

        $requestData = $request->all();
        
        \App\UserDetails::updateOrCreate(['user_id' => $this->user->id], $requestData);

        return redirect()->back()->withMessage('Profile updated successfully!');
    }


    public function updateProfilePicture(Request $request) {


        $request->validate([
            'avatar' => 'image|required'
        ]);

        $requestData = $request->all();
        
        $path = $request->avatar->store('avatars');

        Storage::setVisibility($path, 'public');

        $requestData['avatar']  = Storage::url($path);

        \App\UserDetails::updateOrCreate(['user_id' => $this->user->id], $requestData);

        return redirect()->back()->withMessage('Profile picture updated successfully!');
    }


    public function updateFeedSettings(Request $request) {
        $request->validate([
            'feed_type' => 'required'
        ]);

        $request->user()->settings()->updateOrCreate($request->except('_token'));

        return redirect()->back()->withMessage('Feed Settings updated successfully!');

    }



    public function updatePassword(Request $request) {
                

            $request->validate([
                'old_password' => 'required',
                'password' => 'required|confirmed',
            ]);

            
            if(!Hash::check($request->old_password, $this->user->password)){
                return redirect()->back()->withError('Old password is incorrect');
            }

            $this->user->update(['password' => Hash::make($request->password)]);
        
            return redirect()->back()->withMessage('Password updated successfully!');            

    }

    
    public function deactivateAccount(Request $request) {
                

        $request->validate([
            'password' => 'required',
        ]);

        
        if(!Hash::check($request->password, $this->user->password)){
            return redirect()->back()->withError('Password is incorrect');
        }

        $this->user->update(['is_active' => 0]);

        Auth::logout();

        return redirect()->route('login')->withMessage('Account has been deactivated successfully!');            

}
    
    public function apiList(Request $request) {

        $users = $this->user->where('username', 'like', "%$request->username%")->get();

        $users = $users->map(function ($user) {
            return [
                'id' => $user->username,
                'userId' => $user->id,
                'name' => $user->name,
                'link' => "{{ route('profile.show', ['user' => $user->username]) }}"
            ];
        });

        return $users->toJson();
    }

}
