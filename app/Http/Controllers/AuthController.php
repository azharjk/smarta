<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // TODO: do input validation before using the data
        $credentials = $request->all();
        if ($credentials['password'] != $credentials['confirm_password']) {
            // TODO: handle password not matched properly
            return 'Password not matched';
        }

        $credentials['password'] = bcrypt($credentials['password']);
        // TODO: consider using try catch
        $user = User::create($credentials);
        Auth::login($user, true);

        return redirect()->route('dashboard.index');
    }

    public function login(Request $request)
    {
        // TODO: do input validation before using the data
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (!Auth::attempt($credentials, true)) {
            // TODO: handle incorrect credentials properly
            return 'Incorrect credentials';
        }


        return redirect()->route('dashboard.index');
    }

    public function logout()
    {
        // TODO: assert that user should logged in before loging out
        Auth::logout();

        return redirect()->route('auth.signin');
    }
}
