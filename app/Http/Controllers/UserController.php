<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Polyfill\Uuid\Uuid;

class UserController extends Controller
{
    // ========== Views ==========
    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // ========== Web Auth (Sessions) ==========

    public function webLogin(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Credenciais inválidas',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    public function webRegister(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = new User();
        $user->id = Str::uuid7();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = bcrypt($validated['password'], ['rounds' => 10]);
        $user->email_verified_at = now();
        $user->save();

        Auth::login($user);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // ========== API Auth (Tokens) ==========

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $hashedPassword = bcrypt($validated['password'], ['rounds' => 10]);

        $user = new User();

        $user->id = Uuid::uuid_create('4');
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = $hashedPassword;
        $user->email_verified_at = now();

        $user->save();

        return response()->json(
            [
                'message' => 'Usuário criado com sucesso',
            ],
            201
        );
    }

    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user()->only(['id', 'name', 'email'])
        ]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return response()->json(
                [
                    'message' => 'Credenciais inválidas',
                ],
                401
            );
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]
        );
    }
}
