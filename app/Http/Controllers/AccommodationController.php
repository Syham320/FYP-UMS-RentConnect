<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccommodationForm;
use App\Models\RentalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AccommodationController extends Controller
{
    public function index()
    {
        $accommodations = AccommodationForm::where('studentID', Auth::id())->orderBy('submittedDate', 'desc')->get();
        return view('student.accommodation', compact('accommodations'));
    }

    public function create(Request $request)
    {
        $rentalRequest = null;
        if ($request->has('rental_request_id')) {
            $rentalRequest = RentalRequest::with(['listing.user'])
                ->where('requestID', $request->rental_request_id)
                ->where('studentID', Auth::id())
                ->where('requestStatus', 'accepted')
                ->firstOrFail();
        }
        return view('student.accommodation-form', compact('rentalRequest'));
    }

    public function show($id)
    {
        $accommodation = AccommodationForm::where('registrationID', $id)->where('studentID', Auth::id())->firstOrFail();
        return view('student.accommodation-detail', compact('accommodation'));
    }

    public function store(Request $request)
    {
        // Check if student has approved accommodation and admin hasn't allowed new registration
        $hasApproved = AccommodationForm::where('studentID', Auth::id())->where('status', 'approved')->exists();
        $hasAllowedNew = AccommodationForm::where('studentID', Auth::id())->where('status', 'approved')->where('admin_allowed_new', true)->exists();

        if ($hasApproved && !$hasAllowedNew) {
            return redirect()->back()->withErrors(['general' => 'You already have an approved accommodation registration. You cannot submit another one unless it is declined or approved for a new semester by an admin.']);
        }

        $request->validate([
            'fullName' => 'required|string|max:255',
            'matricNumber' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'landlordName' => 'required|string|max:255',
            'rentalType' => 'required|in:Single Room,Shared Room,Studio',
            'rentalAgreement' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'paymentProof' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'rentalRequestID' => 'nullable|exists:rental_requests,requestID',
        ]);

        // If rentalRequestID is provided, validate it belongs to the student and is accepted
        if ($request->rentalRequestID) {
            $rentalRequest = RentalRequest::where('requestID', $request->rentalRequestID)
                ->where('studentID', Auth::id())
                ->where('requestStatus', 'accepted')
                ->first();
            if (!$rentalRequest) {
                return redirect()->back()->withErrors(['rentalRequestID' => 'Invalid rental request.']);
            }
        }

        $data = $request->only(['fullName', 'matricNumber', 'address', 'landlordName', 'rentalType', 'rentalRequestID']);
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
        $rentalRequest = null;
        if ($accommodation->rentalRequestID) {
            $rentalRequest = RentalRequest::with(['listing.user'])
                ->where('requestID', $accommodation->rentalRequestID)
                ->first();
        }
        return view('student.accommodation-form', compact('accommodation', 'rentalRequest'));
    }

    public function update(Request $request, $id)
    {
        $accommodation = AccommodationForm::where('registrationID', $id)->where('studentID', Auth::id())->firstOrFail();

        $request->validate([
            'fullName' => 'required|string|max:255',
            'matricNumber' => 'required|string|max:255|unique:accommodation_forms,matricNumber,' . $accommodation->registrationID . ',registrationID',
            'address' => 'required|string|max:255',
            'landlordName' => 'required|string|max:255',
            'rentalType' => 'required|in:Single Room,Shared Room,Studio',
            'rentalAgreement' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'paymentProof' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
            'rentalRequestID' => 'nullable|exists:rental_requests,requestID',
        ], [
            'matricNumber.unique' => 'You have already registered accommodations with this matric number.',
        ]);

        // If rentalRequestID is provided, validate it belongs to the student and is accepted
        if ($request->rentalRequestID) {
            $rentalRequest = RentalRequest::where('requestID', $request->rentalRequestID)
                ->where('studentID', Auth::id())
                ->where('requestStatus', 'accepted')
                ->first();
            if (!$rentalRequest) {
                return redirect()->back()->withErrors(['rentalRequestID' => 'Invalid rental request.']);
            }
        }

        $data = $request->only(['fullName', 'matricNumber', 'address', 'landlordName', 'rentalType', 'rentalRequestID']);

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

    public function adminShow($id)
    {
        $accommodation = AccommodationForm::with('student')->findOrFail($id);
        return view('admin.accommodation-detail', compact('accommodation'));
    }

    public function allowNew(Request $request, $id)
    {
        $accommodation = AccommodationForm::findOrFail($id);
        $accommodation->admin_allowed_new = true;
        $accommodation->save();

        return redirect()->back()->with('success', 'Student is now allowed to submit a new accommodation registration for the next semester.');
    }
}
