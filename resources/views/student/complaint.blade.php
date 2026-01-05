@extends('layouts.student')

@section('student-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Complaints & Issues</h1>

    <!-- Complaint Section -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Report an Issue</h2>

        @if(session('success'))
            <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
        @endif

        <div class="text-center">
            <a href="{{ route('student.submit-complaint') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 text-lg inline-block">
                Submit Complaint
            </a>
        </div>
    </div>

    <!-- Recent Complaints -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Your Recent Complaints</h2>

        @if($complaints->count())
            <div class="space-y-4">
                @foreach($complaints as $complaint)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $complaint->complaintCategory }}</h3>
                                <p class="text-sm text-gray-600">Submitted on: {{ $complaint->submittedDate->format('F d, Y \a\t g:i A') }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($complaint->complaintStatus === 'pending') bg-gray-100 text-gray-800
                                @elseif($complaint->complaintStatus === 'In review') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800 @endif">
                                {{ $complaint->complaintStatus }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-700 mt-2">{{ Str::limit($complaint->complaintDescription, 100) }}</p>
                        <a href="{{ route('student.complaint.detail', $complaint->complaintID) }}" class="mt-2 text-blue-600 hover:text-blue-800 text-sm font-medium">View Details</a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-8">
                <p class="text-gray-500">You haven't submitted any complaints yet.</p>
            </div>
        @endif
    </div>


</div>
@endsection
