<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RentalRequest;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class RentalRequestController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'listingID' => 'required|exists:listings,listingID',
            ]);

            $listing = Listing::findOrFail($request->listingID);

            // Check if student already has any pending request
            $existingRequest = RentalRequest::where('studentID', Auth::id())
                ->where('requestStatus', 'pending')
                ->first();

            if ($existingRequest) {
                return response()->json([
                    'success' => false,
                    'message' => 'You already have a pending rental request. Please wait for it to be resolved before submitting a new one.'
                ]);
            }

            // Create the rental request
            $rentalRequest = RentalRequest::create([
                'listingID' => $request->listingID,
                'studentID' => Auth::id(),
                'requestStatus' => 'pending',
            ]);

            // Here you could send notification to landlord
            // Notification::send($listing->user, new RentalRequestNotification($rentalRequest));

            return response()->json([
                'success' => true,
                'message' => 'Rental request submitted successfully!',
                'request' => $rentalRequest
            ]);
        } catch (\Exception $e) {
            \Log::error('Rental request submission error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting the rental request. Please try again.'
            ], 500);
        }
    }

    public function studentRequests()
    {
        $requests = RentalRequest::with(['listing.user'])
            ->where('studentID', Auth::id())
            ->orderBy('requestDate', 'desc')
            ->get();

        return view('student.rental-requests', compact('requests'));
    }

    public function landlordRequests()
    {
        $requests = RentalRequest::with(['listing', 'student'])
            ->whereHas('listing', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('requestDate', 'desc')
            ->get();

        return view('landlord.rental-requests', compact('requests'));
    }

    public function getStatus($requestID)
    {
        $rentalRequest = RentalRequest::with(['listing', 'student'])
            ->where('requestID', $requestID)
            ->whereHas('listing', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'request' => $rentalRequest
        ]);
    }

    public function updateStatus(Request $request, $requestID)
    {
        $status = $request->input('status');

        $request->validate([
            'status' => 'required|in:accepted,declined,rented',
        ]);

        $rentalRequest = RentalRequest::with(['listing', 'student'])
            ->where('requestID', $requestID)
            ->whereHas('listing', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $updateData = [
            'requestStatus' => $status,
        ];

        $rentalRequest->update($updateData);

        // If the request is accepted, automatically decline all other pending requests for the same listing
        if ($status === 'accepted') {
            RentalRequest::where('listingID', $rentalRequest->listingID)
                ->where('requestID', '!=', $requestID)
                ->where('requestStatus', 'pending')
                ->update(['requestStatus' => 'declined']);
        }

        // Here you could send notification to student
        // Notification::send($rentalRequest->student, new RentalRequestStatusNotification($rentalRequest));

        return response()->json([
            'success' => true,
            'message' => 'Request status updated successfully!',
            'request' => $rentalRequest
        ]);
    }
}
