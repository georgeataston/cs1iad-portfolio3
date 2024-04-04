<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        $email = $request->input("email");
        $username = $request->input("username");
        $password = $request->input("password");

        if (!preg_match("^[\w\-\.]+@([\w-]+\.)+[\w-]{2,}$^", $email)) {
            return redirect('register')->with('success', 'false')->with('message', 'Please supply a valid e-mail address');
        }

        if (User::where('email', '=', $email)->exists()) {
            return redirect('register')->with('success', 'false')->with('message', 'E-mail already in use.');
        } else if (User::where('username', '=', $username)->exists()) {
            return redirect('register')->with('success', 'false')->with('message', 'Username already in use.');
        }

        $user = new User;
        $user->email = $email;
        $user->username = $username;
        $user->password = Hash::make($password);
        $user->save();

        return redirect('login')->with('success', 'true');
    }

    public function authenticate(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::where('username', '=', $credentials['username'])->first();
        if (!$user) {
            return back()->with('success', 'false')->with('message', 'Username or password is incorrect');
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->with('success', 'false')->with('message', 'Username or password is incorrect');
        }

        $request->session()->regenerate();
        $request->session()->put('id', $user->uid);
        return redirect('/dashboard');
    }

    public function logout(Request $request): RedirectResponse {
        $request->session()->invalidate();

        return redirect('/');
    }
}
