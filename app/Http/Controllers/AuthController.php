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
        if ($request->validated()){
            User::create([
                'email' => $request->email,
                'name' => $request->name,
                'password' => bcrypt($request->password),
            ]);

            return redirect()->route('login.view')->with('success', 'Usuário cadastrado com sucesso!');
        }

        return redirect()->back()->with('errors', 'Erro ao cadastrar usuário.');
    }
    public function login(LoginRequest $request){
        if ($request->validated()){

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                return redirect()->intended(route('dashboard'));
            }

            return redirect()->back()->with('errors', 'E-mail ou senha incorretos.');
        }

        return redirect()->back()->with('errors', 'Erro ao validar credenciais.');
    }
    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.view');
    }
}
