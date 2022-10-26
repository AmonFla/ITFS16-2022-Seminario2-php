<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('api', [])->plainTextToken;
            return response()->json(['token' => $token, 'nombre' => $user->name], 200);
        } else {
            return response()->json([], 401);
        }
    }

    public function register(Request $request)
    {
        $input = $request->all();

        $userExist = User::where('email', $input['email'])->first();
        if (isset($userExist->id)) {
            return response()->json('usuario existente', 400);
        }

        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->save();

        $token = $user->createToken('api', [])->plainTextToken;
        return response()->json(['token' => $token, 'nombre' => $user->name], 200);
    }
}
