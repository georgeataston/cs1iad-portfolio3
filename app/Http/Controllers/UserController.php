<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);


        if ($input['password'] != $input['confirm_password']) {
            return back()->withErrors(['confirm_password' => 'Passwords do not match.'])->withInput();
        }

        $user = new User;
        $user->email = $input['email'];
        $user->username = $input['username'];
        $user->password = Hash::make($input['password']);
        $user->save();

        return redirect('login')->with('success', 'true');
    }

    public function authenticate(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', '=', $credentials['username'])->first();
        if (!$user) {
            return back()->withErrors(['login' => 'Username or password is incorrect'])->withInput();
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['login' => 'Username or password is incorrect'])->withInput();
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
