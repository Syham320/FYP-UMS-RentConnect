<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showEditForm()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'userName' => 'required|string|max:255',
            'userEmail' => 'required|string|email|max:255|unique:users,userEmail,' . $user->id,
            'contactInfo' => 'nullable|string|max:50',
            'profileImg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $profileImgPath = $user->profileImg;
        if ($request->hasFile('profileImg')) {
            if ($profileImgPath) {
                Storage::disk('public')->delete($profileImgPath);
            }
            $profileImgPath = $request->file('profileImg')->store('profiles', 'public');
        }

        $user->update([
            'userName' => $request->userName,
            'userEmail' => $request->userEmail,
            'contactInfo' => $request->contactInfo,
            'profileImg' => $profileImgPath,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function delete(Request $request)
    {
        $user = Auth::user();

        if ($user->profileImg) {
            Storage::disk('public')->delete($user->profileImg);
        }

        $user->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }
}
