<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'userName' => 'required|string|max:255',
            'userEmail' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'userRole' => 'required|in:Student,Landlord,Admin',
            'contactInfo' => 'nullable|string|max:50',
            'profileImg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profileImgPath = null;
        if ($request->hasFile('profileImg')) {
            $profileImgPath = $request->file('profileImg')->store('profiles', 'public');
        }

        User::create([
            'userName' => $request->userName,
            'userEmail' => $request->userEmail,
            'password' => Hash::make($request->password),
            'userRole' => $request->userRole,
            'contactInfo' => $request->contactInfo,
            'profileImg' => $profileImgPath,
        ]);

        return redirect()->back()->with('success', 'Registration successful! You can now login with your credentials.');
    }
}
