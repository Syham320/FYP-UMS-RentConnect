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
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Landlord</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($accommodations as $accommodation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $accommodation->address }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $accommodation->landlordName }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $accommodation->rentalType }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($accommodation->status == 'approved') bg-green-100 text-green-800
                                    @elseif($accommodation->status == 'rejected') bg-red-100 text-red-800
                                    @else bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($accommodation->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $accommodation->submittedDate->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('student.accommodation.edit', $accommodation->registrationID) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form method="POST" action="{{ route('student.accommodation.destroy', $accommodation->registrationID) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this registration?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white shadow-md rounded-lg p-6">
            <p class="text-gray-500">You haven't registered any accommodations yet.</p>
        </div>
    @endif
</div>
@endsection
