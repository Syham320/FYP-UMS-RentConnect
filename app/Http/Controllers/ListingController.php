<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Bookmark;
use App\Models\RentalRequest;
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
        // Show approved, pending, and rejected listings for the landlord so all statuses are visible with appropriate badges
        $listings = Listing::where('user_id', Auth::id())
            ->whereIn('availabilityStatus', ['approved', 'pending', 'rejected'])
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

    public function showListing($id)
    {
        $listing = Listing::with('user')->findOrFail($id);

        return view('admin.listing-detail', compact('listing'));
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
        // Get listing IDs where any rental request has been accepted
        $acceptedListingIds = RentalRequest::where('requestStatus', 'accepted')
            ->pluck('listingID')
            ->unique()
            ->toArray();

        $listings = Listing::where('availabilityStatus', 'approved')
            ->whereNotIn('listingID', $acceptedListingIds)
            ->with('user')
            ->orderBy('createdDate', 'desc')
            ->get();

        // Get bookmarked listings for the current user
        $bookmarkedListings = [];
        if (Auth::check()) {
            $bookmarkedListings = Auth::user()->bookmarks()->pluck('listingID')->toArray();
        }

        // Get rental requests for the current user
        $requestedListings = [];
        if (Auth::check()) {
            $requestedListings = Auth::user()->rentalRequests()
                ->whereIn('requestStatus', ['pending', 'accepted'])
                ->pluck('listingID')
                ->toArray();
        }

        return view('student.home', compact('listings', 'bookmarkedListings', 'requestedListings'));
    }

    /**
     * Display bookmarked listings for the student.
     */
    public function bookmarks()
    {
        $bookmarks = Auth::user()->bookmarks()
            ->with('listing.user')
            ->orderBy('bookmarkedDate', 'desc')
            ->get();

        // Get listing IDs where any rental request has been accepted
        $acceptedListingIds = RentalRequest::where('requestStatus', 'accepted')
            ->pluck('listingID')
            ->unique()
            ->toArray();

        // Filter out bookmarks where listing might be deleted or not approved
        $bookmarkedListings = $bookmarks->filter(function($bookmark) use ($acceptedListingIds) {
            return $bookmark->listing &&
                   $bookmark->listing->availabilityStatus === 'approved' &&
                   !in_array($bookmark->listing->listingID, $acceptedListingIds);
        })->map(function($bookmark) {
            return $bookmark->listing;
        });

        return view('student.bookmarks', compact('bookmarkedListings'));
    }

    /**
     * Toggle bookmark for a listing.
     */
    public function toggleBookmark($listingId)
    {
        try {
            $listing = Listing::findOrFail($listingId);
            
            // Check if listing is approved
            if ($listing->availabilityStatus !== 'approved') {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot bookmark this listing.'
                ], 403);
            }

            $userId = Auth::id();
            $bookmark = Bookmark::where('user_id', $userId)
                ->where('listingID', $listingId)
                ->first();

            if ($bookmark) {
                // Remove bookmark
                $bookmark->delete();
                return response()->json([
                    'success' => true,
                    'bookmarked' => false,
                    'message' => 'Bookmark removed successfully.'
                ]);
            } else {
                // Add bookmark
                Bookmark::create([
                    'user_id' => $userId,
                    'listingID' => $listingId,
                    'bookmarkedDate' => now()
                ]);
                return response()->json([
                    'success' => true,
                    'bookmarked' => true,
                    'message' => 'Bookmark added successfully.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while toggling bookmark.'
            ], 500);
        }
    }

    /**
     * Search and filter listings.
     */
    public function search(Request $request)
    {
        $query = Listing::where('availabilityStatus', 'approved')
            ->with('user');

        // Keyword search (search in title, description, and location)
        if ($request->filled('query')) {
            $searchTerm = $request->input('query');
            $query->where(function($q) use ($searchTerm) {
                $q->where('listingTitle', 'like', '%' . $searchTerm . '%')
                  ->orWhere('listingDescription', 'like', '%' . $searchTerm . '%')
                  ->orWhere('location', 'like', '%' . $searchTerm . '%');
            });
        }

        // Location filter
        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        // Price range filter
        if ($request->filled('price_range')) {
            switch ($request->input('price_range')) {
                case '0-500':
                    $query->whereBetween('price', [0, 500]);
                    break;
                case '500-1000':
                    $query->whereBetween('price', [500, 1000]);
                    break;
                case '1000+':
                    $query->where('price', '>=', 1000);
                    break;
            }
        }

        // Room type filter
        if ($request->filled('room_type')) {
            $query->where('roomType', $request->input('room_type'));
        }

        // Sorting
        $sortBy = $request->input('sort', 'newest');
        switch ($sortBy) {
            case 'price-low':
                $query->orderBy('price', 'asc');
                break;
            case 'price-high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
            default:
                $query->orderBy('createdDate', 'desc');
                break;
        }

        $listings = $query->get();

        // Get bookmarked listings for the current user
        $bookmarkedListings = [];
        if (Auth::check()) {
            $bookmarkedListings = Auth::user()->bookmarks()->pluck('listingID')->toArray();
        }

        // Get rental requests for the current user
        $requestedListings = [];
        if (Auth::check()) {
            $requestedListings = Auth::user()->rentalRequests()
                ->whereIn('requestStatus', ['pending', 'accepted'])
                ->pluck('listingID')
                ->toArray();
        }

        // Get filter values for maintaining state
        $filters = [
            'query' => $request->input('query'),
            'location' => $request->input('location'),
            'price_range' => $request->input('price_range'),
            'room_type' => $request->input('room_type'),
            'sort' => $sortBy
        ];

        return view('student.search', compact('listings', 'bookmarkedListings', 'filters', 'requestedListings'));
    }
}
