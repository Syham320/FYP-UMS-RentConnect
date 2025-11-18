@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Accommodation Registrations</h1>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
    @endif

    @if($accommodations->count() > 0)
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Landlord</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documents</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($accommodations as $accommodation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $accommodation->student->name }}</td>
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($accommodation->rentalAgreement)
                                    <a href="{{ asset('storage/' . $accommodation->rentalAgreement) }}" target="_blank" class="text-blue-600 hover:text-blue-900 mr-2">Agreement</a>
                                @endif
                                @if($accommodation->paymentProof)
                                    <a href="{{ asset('storage/' . $accommodation->paymentProof) }}" target="_blank" class="text-blue-600 hover:text-blue-900">Proof</a>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                @if($accommodation->status == 'pending')
                                    <form method="POST" action="{{ route('admin.accommodation.approve', $accommodation->registrationID) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-2">Approve</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.accommodation.reject', $accommodation->registrationID) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                    </form>
                                @else
                                    <span class="text-gray-500">{{ ucfirst($accommodation->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No accommodation registrations found</h3>
            <p class="text-gray-600">There are currently no accommodation registrations to manage.</p>
        </div>
    @endif
</div>
@endsection
