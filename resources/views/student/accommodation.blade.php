@extends('layouts.student')

@section('student-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">My Accommodation Registrations</h1>
    <p class="text-gray-600 text-center mb-8">Manage your accommodation registration forms and track their approval status.</p>

    <div class="mb-8 text-center">
        <a href="{{ route('student.accommodation.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 text-lg inline-block">
            Submit accommodation
        </a>
    </div>

    @if($accommodations->count() > 0)
        <div class="space-y-4">
            @foreach($accommodations as $accommodation)
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $accommodation->fullName }}</h3>
                            <p class="text-sm text-gray-600">Submitted on: {{ $accommodation->submittedDate->format('F d, Y') }}</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($accommodation->status == 'approved') bg-green-100 text-green-800
                            @elseif($accommodation->status == 'rejected') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800 @endif">
                            {{ ucfirst($accommodation->status) }}
                        </span>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('student.accommodation.show', $accommodation->registrationID) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-6">
            <p class="text-gray-500">You haven't registered any accommodations yet.</p>
        </div>
    @endif
</div>
@endsection
