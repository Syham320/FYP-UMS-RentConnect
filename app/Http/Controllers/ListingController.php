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

    /**
     * Display approved listings for the landlord in My Listings.
     */
    public function myListings()
    {
        $listings = Listing::where('user_id', Auth::id())
            ->where('availabilityStatus', 'approved')
            ->orderBy('createdDate', 'desc')
            ->get();

        return view('landlord.my-listings', compact('listings'));
    }

    /**
     * Show the form for editing a listing.
     */
    public function edit($id)
    {
        $listing = Listing::where('listingID', $id)->where('user_id', Auth::id())->firstOrFail();

        // Only allow editing if approved
        if ($listing->availabilityStatus !== 'approved') {
            abort(403, 'You can only edit approved listings.');
        }

        return view('landlord.edit-listing', compact('listing'));
    }

    /**
     * Update the specified listing.
     */
    public function update(Request $request, $id)
    {
        $listing = Listing::where('listingID', $id)->where('user_id', Auth::id())->firstOrFail();

        // Only allow updating if approved
        if ($listing->availabilityStatus !== 'approved') {
            abort(403, 'You can only edit approved listings.');
        }

        $request->validate([
            'listingTitle' => 'required|string|max:255',
            'listingDescription' => 'required|string',
            'price' => 'required|numeric|min:0',
            'location' => 'required|string|max:255',
            'contactInfo' => 'nullable|string|max:50',
            'roomType' => 'required|string|max:50',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePaths = $listing->images ?? [];
        if ($request->hasFile('images')) {
            // Delete old images if new ones are uploaded
            foreach ($imagePaths as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('listings', 'public');
                $imagePaths[] = $path;
            }
        }

        $listing->update([
            'listingTitle' => $request->listingTitle,
            'listingDescription' => $request->listingDescription,
            'price' => $request->price,
            'location' => $request->location,
            'contactInfo' => $request->contactInfo,
            'roomType' => $request->roomType,
            'images' => $imagePaths,
        ]);

        return redirect()->route('landlord.my-listings')->with('success', 'Listing updated successfully!');
    }

    public function manageListings()
    {
        $listings = Listing::whereIn('availabilityStatus', ['pending', 'approved', 'rejected'])
            ->with('user')
            ->orderBy('createdDate', 'desc')
            ->get();

        return view('admin.manage-listings', compact('listings'));
    }

    public function approveListing($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update(['availabilityStatus' => 'approved']);

        return redirect()->back()->with('success', 'Listing approved successfully!');
    }

    public function rejectListing($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->update(['availabilityStatus' => 'rejected']);

        return redirect()->back()->with('success', 'Listing rejected successfully!');
    }

    public function studentHome()
    {
        $listings = Listing::where('availabilityStatus', 'approved')
            ->with('user')
            ->orderBy('createdDate', 'desc')
            ->get();
    
        // Get bookmarked listings for the current user
        $bookmarkedListings = [];
        if (Auth::check()) {
            $bookmarkedListings = Auth::user()->bookmarks()->pluck('listingID')->toArray();
        }
    
        return view('student.home', compact('listings', 'bookmarkedListings'));
    }
}
