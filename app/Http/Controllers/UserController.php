<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->has('role') && !empty($request->role)) {
            $query->where('userRole', $request->role);
        }

        // Search by name or email
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('userName', 'like', "%{$search}%")
                  ->orWhere('userEmail', 'like', "%{$search}%");
            });
        }

        // Order by latest if requested
        if ($request->has('latest') && $request->latest == '1') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('created_at', 'asc'); // Default order
        }

        $users = $query->get();

        return view('admin.users', compact('users'));
    }
}
