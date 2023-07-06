<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\AdminLoginEmail;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    //

    public function showLogin(){
        return response()->view('cms.auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'email' =>'required|string|email|exists:admins,email',
            'password' =>'required|string',
            'remember' => 'nullable|in:on',
        ]);

        if(Auth::guard('admin')->attempt($request->only(['email','password']),$request->has('remember'))){
            $admin = Admin::where('email','=',$request->input('email'))->first();
            // Mail::to($admin)->send(new AdminLoginEmail);
            return redirect()->route('cms.home');
        }else{
            return redirect()->back();
        }

    }
    
    public function logout(Request $request){
        $admin = $request->user('admin');
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect()->guest('/cms/admin/login');
    }

    public function editPassword(){
        return response()->view('cms.auth.edit-password');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'old_password' => 'required|current_password:admin',
            'new_password' => ['required','confirmed',
                            Password::min(3)
                            ->letters()
                            ->uncompromised()
                            ->numbers()
                            ->min(8)
                            ->symbols()
                            ->mixedCase()],
        ]);

        $user = $request->user('admin');
        $user->password = Hash::make($request->input('new_password'));
        $saved = $user->save();
        return redirect()->back();
        //diaaDDD2003@@@

    }

}
