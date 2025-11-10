<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'userEmail' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'userEmail' => $request->userEmail,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->userRole) {
                case 'Student':
                    return redirect('/student/dashboard');
                case 'Landlord':
                    return redirect('/landlord/dashboard');
                case 'Admin':
                    return redirect('/admin/dashboard');
                default:
                    return redirect('/dashboard');
            }
        }

        return back()->withErrors(['userEmail' => 'Invalid credentials.']);
    }
}
