<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::with('user');

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('complaintCategory', $request->category);
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('complaintStatus', $request->status);
        }

        // Search by description or user name
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('complaintDescription', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('userName', 'like', "%{$search}%");
                  });
            });
        }

        // Order by latest if requested
        if ($request->has('latest') && $request->latest == '1') {
            $query->orderBy('submittedDate', 'desc');
        } else {
            $query->orderBy('submittedDate', 'asc'); // Default order
        }

        $complaints = $query->get();

        return view('admin.complaint', compact('complaints'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'complaintCategory' => 'required|in:Safety,Fraud,Facilities',
            'complaintDescription' => 'required|string|max:255',
            'complaintFile' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048'
        ]);

        $filePath = null;
        if ($request->hasFile('complaintFile')) {
            $filePath = $request->file('complaintFile')->store('complaints', 'public');
        }

        Complaint::create([
            'complaintCategory' => $request->complaintCategory,
            'complaintDescription' => $request->complaintDescription,
            'complaintFile' => $filePath,
            'userID' => Auth::id(),
            'complaintStatus' => 'pending'
        ]);

        if (Auth::user()->userRole === 'Student') {
            return redirect()->route('student.complaint')->with('success', 'Complaint submitted successfully!');
        }

        return back()->with('success', 'Complaint submitted successfully!');
    }

    public function show($id)
    {
        $complaint = Complaint::with('user')->findOrFail($id);

        // Allow admin to view any complaint, others can only view their own
        if (Auth::user()->userRole !== 'Admin' && $complaint->userID !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if (Auth::user()->userRole === 'Student') {
            return view('student.complaint-detail', compact('complaint'));
        }

        // Admin view
        return view('admin.complaint-detail', compact('complaint'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'complaintStatus' => 'required|in:pending,In review,Resolved'
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->update(['complaintStatus' => $request->complaintStatus]);

        return redirect()->route('admin.complaint')->with('success', 'Complaint status updated successfully!');
    }

    public function userComplaints()
    {
        $complaints = Complaint::where('userID', Auth::id())->orderBy('submittedDate', 'desc')->get();

        if (Auth::user()->userRole === 'Student') {
            return view('student.complaint', compact('complaints'));
        }

        abort(403, 'Unauthorized');
    }
}
