<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\UserVerify;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('auth.login');
    }

    public function registration(){
        return view('auth.registration');
    }

    public function postRegister(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6'
        ]); 

        $data = $request->all();
        $user = $this->create($data);

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token,
        ]);

        Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
            $message->to($request->email); 
            $message->subject("Email Verification Mail"); 
        });


        return redirect('/login')->withSuccess('You have register success..!');
    }

    private function create($data){
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function postLogin(Request $request){
        
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $remember = $request->has('remember') ? true : false ;

        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials, $remember)){
            return redirect('/product')->withSuccess('Login Successfully...!');
        }
        return redirect()->back()->withErrors('Login Not Successfully...!');

    }

    public function dashboard(){
        if(Auth::check()){
            $user = Auth::user();
            return view('auth.dashboard')->with('user',$user);
        }
        return redirect("/login")->withErrors('You do not have access..!');
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('/login')->withSuccess('You have Logout Success...!');
    }

    public function verifyAccount($token){

        $verifyUser = UserVerify::where('token', $token)->first(); 
        $message = "Sorry, your email cannot be identified!"; 

        if(!is_null($verifyUser)){
            $user = $verifyUser->user; 

            if(!$user->is_email_verified){
                $verifyUser->user->is_email_verified = 1; 
                $verifyUser->user->save(); 
                $message = "Your e-mail is verified. You can now login."; 
            }else{
                $message = "Your e-mail is already verified. You can now login."; 
            }
            return redirect()->route("login")->withSuccess($message); 
        }

        return redirect()->route("login")->withErrors($message); 
    }
}
