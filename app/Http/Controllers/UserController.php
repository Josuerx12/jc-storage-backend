<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Polyfill\Uuid\Uuid;

class UserController extends Controller
{
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
