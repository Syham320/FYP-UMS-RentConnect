<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    public function create()
    {
        return view('landlord.create-listing');
    }

    public function store(Request $request)
    {
        $request->validate([
            'listingTitle' => 'required|string|max:255',
            'listingDescription' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'contactInfo' => 'nullable|string|max:50',
            'roomType' => 'required|string|max:50',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB per image
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('listings', 'public'); // Store in public/images/listings
                $imagePaths[] = $path;
            }
        }

        Listing::create([
            'listingTitle' => $request->listingTitle,
            'listingDescription' => $request->listingDescription,
            'price' => $request->price,
            'location' => $request->location,
            'contactInfo' => $request->contactInfo,
            'roomType' => $request->roomType,
            'availabilityStatus' => 'pending',
            'user_id' => Auth::id(),
            'images' => $imagePaths,
        ]);

        // After creating a listing keep user on their listings overview (not the approved-only page)
        return redirect()->route('landlord.my-listings')->with('success', 'Listing created successfully!');
    }

    /**
     * Show only the listings that are approved for the currently authenticated landlord.
     */
    public function approvedListings()
    {
        // Show both approved and pending listings for the landlord so pending items are visible with a 'Pending' badge
        $listings = Listing::where('user_id', Auth::id())
            ->whereIn('availabilityStatus', ['approved', 'pending'])
            ->orderBy('createdDate', 'desc')
            ->get();

        return view('landlord.approved-listings', compact('listings'));
    }
}