<?php

namespace App\Http\Controllers;

use App\Models\Amv;
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
        if (Auth::attempt(['email' => $request->email_address, 'password' => $request->password])) {
            /** @var \App\Models\user $user */
            $user = Auth::user();

            $token = $user->createToken('main')->plainTextToken;
            unset($user['created_at'], $user['updated_at'], $user['email_verified_at']);

            return response()->json([
                'user' => $user,
                'token' => $token,
                'success' => true
            ]);
        }

        return response()->json([
            'error' => 'The provided credentials are not correct',
            'success' => false
        ], 400);
    }

    public function logout()
    {
        return response([
            'success' => true,
        ]);
        /** @var User $user */
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response([
            'success' => true,
        ]);
    }

    public function get(Request $request)
    {
        $user = User::where('username', $request->username)->with('amv')->first();
        $userId = auth('sanctum')->user()?->id;
        $posts = Amv::where('user_id', $user->id)->with('user')->leftJoinSub(function ($query) use ($userId) {
            $query->select('amv_id', 'type')
                ->from('amv_reactions')
                ->where('user_id', $userId);
        }, 'user_reaction', function ($join) {
            $join->on('amvs.id', '=', 'user_reaction.amv_id');
        })
            ->select('amvs.*', 'user_reaction.type as user_reaction')
            ->limit(6)
            ->orderBy('created_at', 'DESC')
            ->get();

        if ($user) {
            return response([
                'user' => $user,
                'posts' => $posts
            ]);
        }
        return response([
            'user' => false
        ]);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:15',
            'last_name' => 'required|string|max:15',
            'username' => 'required|regex:/^[a-zA-Z0-9.]+$/|max:15|unique:users,username,' . auth()->user()->id,
            'email' => 'required|email|unique:users,email,' . auth()->user()->id
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ]);
        }

        $user = auth()->user();
        if ($user->id === $request->id) {
            $user->firstName = $request->first_name;
            $user->lastName = $request->last_name;
            $user->lastName = $request->last_name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->save();
            return response([
                'errors' =>  false,
                'user' => auth()->user()
            ]);
        }
        return response([
            'errors' =>  true
        ]);
    }
}
