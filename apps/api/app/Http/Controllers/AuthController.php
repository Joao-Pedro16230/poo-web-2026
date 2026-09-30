<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        // Obtém os dados informados pelo usuário
        $username = $request->validated('username');
        $password = $request->validated('password');

        // Procura o usuário pelo email
        $user = User::firstWhere('email', $username);

        // Verifica se o usuário existe e se a senha está correta
        if (
            $user &&
            Hash::check($password, $user->password)
        ) {
            // Cria o token de acesso
            $token = $user->createToken($user->name);

            // Retorna o token e os dados do usuário
            return [
                'token' => $token->plainTextToken,
                'user' => $user,
            ];
        }

        // Caso email ou senha estejam incorretos
        return response()->json([
            'message' => 'Credenciais inválidas',
        ], Response::HTTP_UNAUTHORIZED);
    }
}