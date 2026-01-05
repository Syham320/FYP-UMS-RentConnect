@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manage User Complaints</h1>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
    @endif

    @if($complaints->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($complaints as $complaint)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $complaint->user ? ($complaint->user->userName ?: 'Unknown User') : 'Unknown User' }}</div>
                                <div class="text-xs text-gray-400">{{ $complaint->user ? ($complaint->user->userRole ?: 'Student') : 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($complaint->complaintCategory === 'Safety') bg-red-100 text-red-800
                                    @elseif($complaint->complaintCategory === 'Fraud') bg-orange-100 text-orange-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ $complaint->complaintCategory }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ Str::limit($complaint->complaintDescription, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($complaint->complaintStatus === 'pending') bg-gray-100 text-gray-800
                                    @elseif($complaint->complaintStatus === 'In review') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ $complaint->complaintStatus }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $complaint->submittedDate->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.complaint.detail', $complaint->complaintID) }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                    <i class="fas fa-eye mr-1"></i>View Details
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No complaints found</h3>
            <p class="text-gray-600">There are currently no user complaint submissions to manage.</p>
        </div>
    @endif
</div>
@endsection
