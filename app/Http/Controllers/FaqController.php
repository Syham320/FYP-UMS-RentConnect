<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::with('admin')->orderBy('updatedDate', 'desc')->get();
        return view('admin.faqs', compact('faqs'));
    }

    public function create()
    {
        return view('admin.create-faq');
    }

    public function edit(Faq $faq)
    {
        return view('admin.edit-faq', compact('faq'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_role' => 'required|in:Student,Landlord',
            'category' => 'required|string|max:100',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => 'boolean',
        ]);

        Faq::create([
            'user_role' => $request->user_role,
            'category' => $request->category,
            'faqQuestion' => $request->question,
            'faqAnswer' => $request->answer,
            'is_active' => $request->has('is_active'),
            'adminID' => Auth::id(),
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created successfully.');
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'user_role' => 'required|in:Student,Landlord',
            'category' => 'required|string|max:100',
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $faq->update([
            'user_role' => $request->user_role,
            'category' => $request->category,
            'faqQuestion' => $request->question,
            'faqAnswer' => $request->answer,
            'is_active' => $request->has('is_active'),
            'adminID' => Auth::id(),
        ]);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted successfully.');
    }

    public function toggle(Faq $faq)
    {
        $faq->update(['is_active' => !$faq->is_active]);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ status updated successfully.');
    }
}
