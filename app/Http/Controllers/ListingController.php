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
            'userID' => Auth::id(),
            'images' => json_encode($imagePaths), // Store as JSON
        ]);

        return redirect()->route('landlord.approved-listings')->with('success', 'Listing created successfully!');
    }
}
