<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\PasswordReset;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;



class AuthController extends Controller
{

    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register() {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
                            'username' => 'required|unique:users',
                            'email' => 'required|email|unique:users',
                            'password' => 'required'
                        ]);
                        
        $requestData = $request->all();
        $requestData['password'] = Hash::make($requestData['password']);
        $requestData['is_active'] = true;
        $user = $this->user->create($requestData);

        $user->details()->create();
        $user->coins()->create();

        Auth::login($user);

        if($request->has('utm_redirect')) {
            return redirect()->intended($request->utm_redirect);
            // return redirect(route('login').'?utm_redirect='.$request->utm_redirect)->withMessage('Account created successfully. Please login to continue');            
        }

        return redirect()->route('home')->withMessage('Account created successfully. Welcome the the JaraCentral Community!');
    }

    public function login() {
        if(Auth::check()) {
            return redirect()->route('home');
        }


        return view('auth.login');
    }

    public function postLogin(Request $request){

        $user = $this->user->where('email', $request->username)->orWhere('username', $request->username)->first();

        if (!$user) {
            return redirect()->back()->withError('Invalid username/password');
        }

        if (!$user->is_active) {
            return redirect()->back()->withError('Sorry, your account has been deactivated. If this is an error, please contact admin.');
        }


        if(!Auth::attempt(['username' => $user->original_username, 'password' => $request->password])){
            return redirect()->route('login')->withError('Invalid username/password');
        }

        if(!$user->coins) {
            $user->coins()->create();
        }

        if($request->has('utm_redirect')) {
            return redirect()->intended($request->utm_redirect);
        }

        return redirect()->intended(route('home'));
    }



    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $userData = User::where('google_id', $user->id)->first();

            if(!$userData) {
                $username = explode('@', $user->email)[0];

                if($this->user->where('username', $username)->count() > 0) {
                    $username = $username.Str::random(6);
                }
    
                $userData = $this->user->firstOrNew(['email' => $user->email, 'username' => $username, 'google_id' => $user->id], [
                    'password' => Str::random(40),
                ]);
                
                
        
            }
              if(!$userData->coins) {
                    $userData->coins()->create();
                }


            $userData->details()->firstOrNew(['user_id' => $userData->id], [
                'avatar' => $user->avatar_original,
                'first_name' => $user->user ? $user->user['given_name'] : null,
                'last_name' => $user->user ? $user->user['family_name'] : null,
            ]);

            Auth::login($userData, true);


            return redirect()->intended(route('home'));
        } catch (Exception $e) {
            return redirect('auth/google');
        }

    }


    public function forgotPassword(PasswordReset $token = null) {

        if($token) {
            //Check if token has expired too tho...
            return view('auth.reset-password', compact('token'));
        }

        return view('auth.forgot-password');
    }

    public function postForgotPassword(Request $request) {
        $user = $this->user->where('email', $request->username)->orWhere('username', $request->username)->first();


        if (!$user) {
            return redirect()->back()->withError('User account does not exist. Please confirm your details and try again');
        }

        $token = Str::random(40);
        $user->passwordReset()->create(['token' => $token]);

        //Send mail
        Mail::to($user->email)->queue(new PasswordResetMail($user, $token));

        return redirect()->back()->withMessage('A passsword reset link has been sent to your email address. Please check your mail to continue');
    }



    public function storePassword(Request $request) {
        
        if(!$request->user()) {
            $request->validate([
                'email' => 'required|exists:users',
                'password' => 'required|confirmed',
            ]);

            $user = $this->user->where('email', $request->email)->first();

            $user->update(['password' => Hash::make($request->password)]);
    
            //Delete all tokens for that user
            $user->passwordReset()->delete();
    
            return redirect()->route('login')->withMessage('Password updated successfully! Please login to continue');            

        } else {
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|confirmed',
            ]);

            $user = $request->user();

            if(!Hash::check($request->old_password, $user->password)){
                return redirect()->back()->withError('Old password is incorrect');
            }
    
            $user->update(['password' => Hash::make($request->password)]);

            return redirect()->back()->withMessage('Password updated successfully!');            
        }


    }



    public function logout() {
        Auth::logout();

        return redirect()->intended(route('home'));
    }
}
