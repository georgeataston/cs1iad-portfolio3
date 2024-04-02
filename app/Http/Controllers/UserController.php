<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function create(Request $request): View {
        $email = $request->input("email");
        $username = $request->input("username");
        $password = $request->input("password");
        error_log($email);

        if (User::where('email', '=', $email)->exists() || User::where('username', '=', $username)->exists()) {
            error_log("fail");
            return view('home');
        }

        $user = new User;
        $user->email = $email;
        $user->username = $username;
        $user->password = Hash::make($password);
        $user->save();

        error_log("success");
        return view('home');
    }
}
