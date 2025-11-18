<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccommodationForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccommodationController extends Controller
{
    public function index()
    {
        $accommodations = AccommodationForm::where('studentID', Auth::id())->orderBy('submittedDate', 'desc')->get();
        return view('student.accommodation', compact('accommodations'));
    }

    public function create()
    {
        return view('student.accommodation-form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'landlordName' => 'required|string|max:255',
            'rentalType' => 'required|in:Single Room,Shared Room,Studio',
            'rentalAgreement' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'paymentProof' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['address', 'landlordName', 'rentalType']);
        $data['studentID'] = Auth::id();

        if ($request->hasFile('rentalAgreement')) {
            $data['rentalAgreement'] = $request->file('rentalAgreement')->store('accommodation_documents', 'public');
        }

        if ($request->hasFile('paymentProof')) {
            $data['paymentProof'] = $request->file('paymentProof')->store('accommodation_documents', 'public');
        }

        AccommodationForm::create($data);

        return redirect()->route('student.accommodation')->with('success', 'Accommodation registration submitted successfully.');
    }

    public function edit($id)
    {
        $accommodation = AccommodationForm::where('registrationID', $id)->where('studentID', Auth::id())->firstOrFail();
        return view('student.accommodation-form', compact('accommodation'));
    }

    public function update(Request $request, $id)
    {
        $accommodation = AccommodationForm::where('registrationID', $id)->where('studentID', Auth::id())->firstOrFail();

        $request->validate([
            'address' => 'required|string|max:255',
            'landlordName' => 'required|string|max:255',
            'rentalType' => 'required|in:Single Room,Shared Room,Studio',
            'rentalAgreement' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'paymentProof' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['address', 'landlordName', 'rentalType']);

        if ($request->hasFile('rentalAgreement')) {
            if ($accommodation->rentalAgreement) {
                Storage::disk('public')->delete($accommodation->rentalAgreement);
            }
            $data['rentalAgreement'] = $request->file('rentalAgreement')->store('accommodation_documents', 'public');
        }

        if ($request->hasFile('paymentProof')) {
            if ($accommodation->paymentProof) {
                Storage::disk('public')->delete($accommodation->paymentProof);
            }
            $data['paymentProof'] = $request->file('paymentProof')->store('accommodation_documents', 'public');
        }

        $accommodation->update($data);

        return redirect()->route('student.accommodation')->with('success', 'Accommodation registration updated successfully.');
    }

    public function destroy($id)
    {
        $accommodation = AccommodationForm::where('registrationID', $id)->where('studentID', Auth::id())->firstOrFail();

        if ($accommodation->rentalAgreement) {
            Storage::disk('public')->delete($accommodation->rentalAgreement);
        }

        if ($accommodation->paymentProof) {
            Storage::disk('public')->delete($accommodation->paymentProof);
        }

        $accommodation->delete();

        return redirect()->route('student.accommodation')->with('success', 'Accommodation registration deleted successfully.');
    }

    public function adminIndex()
    {
        $accommodations = AccommodationForm::with('student')->orderBy('submittedDate', 'desc')->get();
        return view('admin.accommodation', compact('accommodations'));
    }

    public function approve($id)
    {
        $accommodation = AccommodationForm::findOrFail($id);
        $accommodation->update(['status' => 'approved']);

        // TODO: Notify student of approval

        return redirect()->route('admin.accommodation')->with('success', 'Accommodation registration approved.');
    }

    public function reject($id)
    {
        $accommodation = AccommodationForm::findOrFail($id);
        $accommodation->update(['status' => 'rejected']);

        // TODO: Notify student of rejection

        return redirect()->route('admin.accommodation')->with('success', 'Accommodation registration rejected.');
    }
}
