<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;


class AuthController extends Controller
{
    public function register(RegisterRequest $request){
            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => bcrypt($request->password),
            ]);

            if ($user) {
                return redirect()->route('login.view')->with('success', 'User registered successfully!');
            }


        return redirect()->back()->withErrors(['auth' => 'Error registering user try again later.'])->withInput();
    }
    public function login(LoginRequest $request){
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended(route('dashboard'));
            }

            return redirect()->back()->withErrors(['auth' => 'Incorrect email or password.'])->withInput();
    }
    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.view');
    }
}
