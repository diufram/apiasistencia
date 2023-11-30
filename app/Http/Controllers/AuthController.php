<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller

{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'min:8'],

        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipo' => $request->tipo,
            'telefono' => $request->telefono,
        ]);
        if($user->tipo == "p"){
            $taller = new Taller();
        $taller->nombre = $request->nameTaller;
        $taller->telefono = $request->telefono;
        $taller->propietario_id = $user->id;
        $taller->ubicacion = "...";

        $taller->save();
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user, 'access_token' => $token, 'token_type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {

        $data = ["success" => false, "mensaje" => "Usuario no registrado"];

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::whereEmail($request->email)->first();
        if (!empty($user)) {
            $data = ["success" => false, "mensaje" => "Contrasña incorrecta"];
            if (Hash::check($request->password, $user->password)) {
                $accessToken = $user->createToken("auth_token")->plainTextToken;
                $data = [
                    "success" => true,
                    "mensaje" => "Usuario Autenticado",
                    "user_id" => $user->id,
                    "access_token" => $accessToken
                ];
                return response()->json([
                    'user' => $user, 'access_token' => $accessToken, 'token_type' => 'Bearer'
                ]);
            }
        }
        return response()->json($data, 404);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            'message' => 'Cerraste Session Tokens borrados',
            'usuario' => $user,
        ]);
    }

    public function token(Request $request)
    {
        $user = $request->user();
        return response()->json([
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "tipo" => $user->tipo
        ], 200);
    }
}
