<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class UsersController extends Controller
{

    public function register(Request $request)
    {
        $validatore = Validator($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone'
        ]);

        if (!$validatore->fails()) {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $saved = $user->save();
            return response()->json(['status' => $saved, 'message' => $saved ? 'register successfuly' : 'Registration filed', 'object' => $user], $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['status' => false, 'message' => $validatore->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function login(Request $request)
    {
        $validatore = Validator($request->all(), [
            'phone' => 'required|exists:users,phone',
        ]);
        if (!$validatore->fails()) {
            $user = User::where('phone', '=', $request->input('phone'))->first();
            $token = $user->createToken('users-api-token-' . $user->id);
            $user->token = $token->accessToken;
            return response()->json(['status' => true, 'object' => $user]);
        } else {
            return response()->json(['status' => false, 'message' => $validatore->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);

        }
    }

    public function logout(Request $request)
    {

        $user = $request->user('admin-api');
        $revoked = $user->token()->revoke();
        return response()->json(['status' => $revoked, 'message' => $revoked ? 'logout successfully' : 'faild logout'], $revoked ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
