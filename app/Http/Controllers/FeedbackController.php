<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('user')->orderBy('timeStamp', 'desc')->get();
        return view('admin.feedback', compact('feedbacks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'feedbackType' => 'required|in:Suggestion,Complaint,Bug',
            'subject' => 'required|string|max:100',
            'feedbackText' => 'required|string|max:255',
            'priority' => 'sometimes|in:High,Medium,Low'
        ]);

        Feedback::create([
            'feedbackType' => $request->feedbackType,
            'subject' => $request->subject,
            'feedbackText' => $request->feedbackText,
            'userID' => Auth::id(),
            'priority' => $request->priority ?? 'Medium',
            'status' => 'In Review'
        ]);

        if (Auth::user()->userRole === 'Student') {
            return redirect()->route('student.feedback')->with('success', 'Feedback submitted successfully!');
        } elseif (Auth::user()->userRole === 'Landlord') {
            return redirect()->route('landlord.feedback')->with('success', 'Feedback submitted successfully!');
        }

        return back()->with('success', 'Feedback submitted successfully!');
    }

    public function show($id)
    {
        $feedback = Feedback::with('user')->findOrFail($id);

        // Allow admin to view any feedback, others can only view their own
        if (Auth::user()->userRole !== 'Admin' && $feedback->userID !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        if (Auth::user()->userRole === 'Student') {
            return view('student.feedback-detail', compact('feedback'));
        } elseif (Auth::user()->userRole === 'Landlord') {
            return view('landlord.feedback-detail', compact('feedback'));
        }

        // Admin view
        return view('admin.feedback-detail', compact('feedback'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:In Review,Resolved,Closed'
        ]);

        $feedback = Feedback::findOrFail($id);
        $feedback->update(['status' => $request->status]);

        return redirect()->route('admin.feedback')->with('success', 'Feedback status updated successfully!');
    }

    public function userFeedback()
    {
        $feedbacks = Feedback::where('userID', Auth::id())->orderBy('timeStamp', 'desc')->get();

        if (Auth::user()->userRole === 'Student') {
            return view('student.feedback', compact('feedbacks'));
        } elseif (Auth::user()->userRole === 'Landlord') {
            return view('landlord.feedback', compact('feedbacks'));
        }

        abort(403, 'Unauthorized');
    }
}
