<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{
    public function register(Request $request)
    {
        $val = Validator::make($request->all(), [
            'first_name' => 'required|string|max:15',
            'last_name' => 'required|string|max:15',
            'email_address' => 'required|email|string|unique:users,email',
            'password' => [
                'required',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ]
        ]);

        if ($val->fails()) {
            return response()->json(
                [
                    'error' => $val->errors(),
                    'success' => false
                ],
                400
            );
        }
        $data = request()->all();

        /** @var \App\Models\user $user */
        $user = User::create([
            'firstName' => $data['first_name'],
            'lastName' => $data['last_name'],
            'email' => $data['email_address'],
            'password' => bcrypt($data['password']),
        ]);

        $token = $user->createToken('main')->plainTextToken;
        unset($user['created_at'], $user['updated_at']);
        return response([
            'user' => $user,
            'token' => $token,
            'success' => true
        ]);
    }



    public function login(Request $request)
    {
        $remember = $request->remember ?? false;


        if (Auth::attempt(['email' => $request->emai, 'password' => $request->password])) {
            /** @var \App\Models\user $user */
            $user = Auth::user();

            $token = $user->createToken('main')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token,
                'email' => $remember

            ]);
        }

        return response()->json([
            'error' => 'The provided credentials are not correct',
            'email' => $remember
        ], 400);
    }

    public function logout()
    {
        /** @var User $user */
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response([
            'success' => true,
        ]);
    }
}
