<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function login(){

        if(View::exists('user.login')){
            return view('user.login');
        }else{
            return abort(404);
        }
        // return view('user.login');

    }

    public function process(Request $request){
        $validated = $request->validate([
            "email" =>['required', 'email'],
            'password' => 'required'
        ]);
        if(auth()->attempt($validated)){
            $request->session()->regenerate();
            return redirect('/')->with('message', 'Welcome Back!');
        }

        return back()->withErrors(['email'=> 'Login failde'])->onlyInput('email');

    }

    public function register(){
        return view('user.register');

    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('message','Logout sucessfull');
    }

    public function store(Request $request){
        // dd($request);
        $validated = $request->validate([
            "name" => ['required', 'min:4'],
            "email" =>['required', 'email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $user = User::create($validated);

        auth()->login($user);

        // return $user;
    }
}
