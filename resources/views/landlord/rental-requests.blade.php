@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Rental Requests</h1>
    <p class="text-gray-600 text-center mb-8">Here you can view all rental requests for your listings from students.</p>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if($requests->count() > 0)
        <div class="space-y-6">
            @foreach($requests as $request)
                <div class="bg-white rounded-lg shadow-lg p-6 border-l-4
                    @if($request->requestStatus == 'pending') border-yellow-500
                    @elseif($request->requestStatus == 'accepted') border-green-500
                    @else border-red-500
                    @endif">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">{{ $request->listing->listingTitle }}</h2>
                            <p class="text-gray-600">{{ $request->listing->location }}</p>
                            <p class="text-lg font-medium text-green-600">RM {{ number_format($request->listing->price, 2) }}/month</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                @if($request->requestStatus == 'pending') text-yellow-800 bg-yellow-100
                                @elseif($request->requestStatus == 'accepted') text-green-800 bg-green-100
                                @else text-red-800 bg-red-100
                                @endif">
                                {{ ucfirst($request->requestStatus) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-500">
                            <p>Requested by: {{ $request->student->userName }}</p>
                            <p>Submitted on: {{ $request->requestDate->format('F j, Y \a\t g:i A') }}</p>
                            @if($request->requestStatus == 'accepted')
                                <p>Accepted on: {{ $request->updated_at->format('F j, Y \a\t g:i A') }}</p>
                            @elseif($request->requestStatus == 'declined')
                                <p>Declined on: {{ $request->updated_at->format('F j, Y \a\t g:i A') }}</p>
                            @endif
                        </div>
                        <div class="space-x-2">
                            @if($request->requestStatus == 'pending')
                                <button onclick="updateRequestStatus({{ $request->requestID }}, 'accepted')"
                                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded update-status-btn"
                                        data-status="accepted">
                                    Accept
                                </button>
                                <button onclick="updateRequestStatus({{ $request->requestID }}, 'declined')"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded update-status-btn"
                                        data-status="declined">
                                    Decline
                                </button>
                            @else
                                <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded view-details-btn"
                                        data-student-name="{{ $request->student->userName }}"
                                        data-student-email="{{ $request->student->userEmail }}"
                                        data-student-contact="{{ $request->student->contactInfo }}"
                                        data-listing-title="{{ $request->listing->listingTitle }}"
                                        data-listing-location="{{ $request->listing->location }}"
                                        data-listing-price="{{ number_format($request->listing->price, 2) }}"
                                        data-request-date="{{ $request->requestDate->format('F j, Y \a\t g:i A') }}"
                                        data-request-status="{{ ucfirst($request->requestStatus) }}">
                                    View Details
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No Rental Requests Yet</h3>
            <p class="text-gray-500">You don't have any rental requests for your listings at the moment.</p>
        </div>
    @endif



    <!-- Note about managing requests -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                </svg>
            </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">
                        Managing Rental Requests
                    </h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Review each request carefully. You can accept or decline requests based on your availability and preferences. </p>
                    </div>
                </div>
        </div>
    </div>
</div>

<!-- Modal for View Details -->
<div id="viewDetailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md max-h-screen overflow-y-auto">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Student Profile & Rental Request Details</h3>
                <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Student Profile Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-md font-semibold text-gray-800 mb-3">Student Information</h4>
                    <div class="space-y-2">
                        <p class="text-sm"><span class="font-medium">Name:</span> <span id="studentName"></span></p>
                        <p class="text-sm"><span class="font-medium">Email:</span> <span id="studentEmail"></span></p>
                        <p class="text-sm"><span class="font-medium">Contact:</span> <span id="studentContact"></span></p>
                    </div>
                </div>
                <!-- Rental Listing Section -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="text-md font-semibold text-gray-800 mb-3">Requested Listing</h4>
                    <div class="space-y-2">
                        <p class="text-sm"><span class="font-medium">Title:</span> <span id="listingTitle"></span></p>
                        <p class="text-sm"><span class="font-medium">Location:</span> <span id="listingLocation"></span></p>
                        <p class="text-sm"><span class="font-medium">Price:</span> RM <span id="listingPrice"></span>/month</p>
                        <p class="text-sm"><span class="font-medium">Request Date:</span> <span id="requestDate"></span></p>
                        <p class="text-sm"><span class="font-medium">Status:</span> <span id="requestStatus" class="px-2 py-1 text-xs font-semibold rounded-full"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function updateRequestStatus(requestId, status) {
    if (!confirm(`Are you sure you want to ${status} this rental request?`)) {
        return;
    }

    const buttons = document.querySelectorAll('.update-status-btn');
    buttons.forEach(btn => btn.disabled = true);

    fetch(`/landlord/rental-requests/${requestId}/status`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            status: status
        })
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                console.error('Server error:', response.status, response.statusText, text);
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            location.reload(); // Reload to show updated status
        } else {
            console.error('Application error:', data.message);
            alert(data.message || 'Failed to update request status');
        }
    })
    .catch(error => {
        console.error('Error updating request status:', error);
        alert('An error occurred while updating the request status. Check console for details.');
    })
    .finally(() => {
        buttons.forEach(btn => btn.disabled = false);
    });
}

// Modal functionality for View Details
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('viewDetailsModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const viewDetailsBtns = document.querySelectorAll('.view-details-btn');

    // Function to open modal and populate data
    function openModal(button) {
        const studentName = button.getAttribute('data-student-name');
        const studentEmail = button.getAttribute('data-student-email');
        const studentContact = button.getAttribute('data-student-contact');
        const studentImage = button.getAttribute('data-student-image');
        const listingTitle = button.getAttribute('data-listing-title');
        const listingLocation = button.getAttribute('data-listing-location');
        const listingPrice = button.getAttribute('data-listing-price');
        const requestDate = button.getAttribute('data-request-date');
        const requestStatus = button.getAttribute('data-request-status');

        // Populate student info
        document.getElementById('studentName').textContent = studentName;
        document.getElementById('studentEmail').textContent = studentEmail;
        document.getElementById('studentContact').textContent = studentContact || 'Not provided';

        // Populate listing info
        document.getElementById('listingTitle').textContent = listingTitle;
        document.getElementById('listingLocation').textContent = listingLocation;
        document.getElementById('listingPrice').textContent = listingPrice;
        document.getElementById('requestDate').textContent = requestDate;

        // Set status with appropriate color
        const statusElement = document.getElementById('requestStatus');
        statusElement.textContent = requestStatus;
        statusElement.className = 'px-2 py-1 text-xs font-semibold rounded-full';

        if (requestStatus === 'Accepted') {
            statusElement.classList.add('text-green-800', 'bg-green-100');
        } else if (requestStatus === 'Declined') {
            statusElement.classList.add('text-red-800', 'bg-red-100');
        } else {
            statusElement.classList.add('text-yellow-800', 'bg-yellow-100');
        }

        // Show modal
        modal.classList.remove('hidden');
    }

    // Function to close modal
    function closeModal() {
        modal.classList.add('hidden');
    }

    // Event listeners
    viewDetailsBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            openModal(this);
        });
    });

    closeModalBtn.addEventListener('click', closeModal);

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});
</script>
@endsection
