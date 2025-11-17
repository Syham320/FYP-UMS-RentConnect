@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Manage User Feedback</h1>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
    @endif

    @php
        // Mock data for user feedback
        $feedbacks = collect([
            (object) [
                'id' => 1,
                'user_name' => 'Ahmad bin Abdullah',
                'user_email' => 'ahmad.abdullah@student.ums.edu.my',
                'user_role' => 'Student',
                'feedback_type' => 'Bug Report',
                'subject' => 'App Performance Issue',
                'message' => 'The search functionality is slow when filtering by location. It takes about 5-7 seconds to load results.',
                'priority' => 'Medium',
                'status' => 'In Review',
                'submitted_date' => '2023-11-15 15:45:00'
            ],
            (object) [
                'id' => 2,
                'user_name' => 'Nur binti Hassan',
                'user_email' => 'nur.hassan@student.ums.edu.my',
                'user_role' => 'Student',
                'feedback_type' => 'Feature Request',
                'subject' => 'Dark Mode Feature',
                'message' => 'It would be great to have a dark mode option for better usability at night. Many users prefer dark themes.',
                'priority' => 'Low',
                'status' => 'Resolved',
                'submitted_date' => '2023-11-12 11:20:00'
            ],
            (object) [
                'id' => 3,
                'user_name' => 'Muhammad bin Ismail',
                'user_email' => 'muhammad.ismail@landlord.com',
                'user_role' => 'Landlord',
                'feedback_type' => 'General Feedback',
                'subject' => 'Platform Appreciation',
                'message' => 'Great platform! The rental request system works well and communication with students is smooth.',
                'priority' => 'Low',
                'status' => 'In Review',
                'submitted_date' => '2023-11-10 09:15:00'
            ],
            (object) [
                'id' => 4,
                'user_name' => 'Siti binti Rahman',
                'user_email' => 'siti.rahman@student.ums.edu.my',
                'user_role' => 'Student',
                'feedback_type' => 'Bug Report',
                'subject' => 'Login Issues',
                'message' => 'Having trouble logging in with my student email. Getting an authentication error.',
                'priority' => 'High',
                'status' => 'Resolved',
                'submitted_date' => '2023-11-14 16:30:00'
            ],
            (object) [
                'id' => 5,
                'user_name' => 'Ahmad bin Abdullah',
                'user_email' => 'ahmad.abdullah@student.ums.edu.my',
                'user_role' => 'Student',
                'feedback_type' => 'Feature Request',
                'subject' => 'Bookmark Feature Enhancement',
                'message' => 'Can we have folders/categories for bookmarks? It would help organize saved listings better.',
                'priority' => 'Medium',
                'status' => 'In Review',
                'submitted_date' => '2023-11-13 14:22:00'
            ]
        ]);
    @endphp

    @if($feedbacks->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Priority</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Submitted</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($feedbacks as $feedback)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $feedback->user_name }}</div>
                                <div class="text-sm text-gray-500">{{ $feedback->user_email }}</div>
                                <div class="text-xs text-gray-400">{{ $feedback->user_role }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($feedback->feedback_type === 'Bug Report') bg-red-100 text-red-800
                                    @elseif($feedback->feedback_type === 'Feature Request') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $feedback->feedback_type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $feedback->subject }}</div>
                                <div class="text-sm text-gray-500 truncate max-w-xs">{{ Str::limit($feedback->message, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($feedback->priority === 'High') bg-red-100 text-red-800
                                    @elseif($feedback->priority === 'Medium') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ $feedback->priority }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($feedback->status === 'In Review') bg-yellow-100 text-yellow-800
                                    @elseif($feedback->status === 'Resolved') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $feedback->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($feedback->submitted_date)->format('M d, Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900 mr-2" onclick="openFeedbackModal({{ $feedback->id }})">View Details</button>
                                @if($feedback->status !== 'Resolved' && $feedback->status !== 'Closed')
                                    <form method="POST" action="#" class="inline">
                                        @csrf
                                        <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                                        <button type="submit" name="action" value="resolve" class="text-green-600 hover:text-green-900">Resolve</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No feedback found</h3>
            <p class="text-gray-600">There are currently no user feedback submissions to manage.</p>
        </div>
    @endif
</div>

<!-- Feedback Details Modal -->
<div id="feedbackModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Feedback Details</h3>
                <button onclick="closeFeedbackModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
    </div>
</div>

<script>
function openFeedbackModal(feedbackId) {
    // Mock feedback data - in real app this would come from server
    const feedbacks = @json($feedbacks)
    const feedback = feedbacks.find(f => f.id === feedbackId);

    if (feedback) {
        document.getElementById('modalTitle').textContent = feedback.subject;
        document.getElementById('modalContent').innerHTML = `
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">User</label>
                        <p class="text-sm text-gray-900">${feedback.user_name}</p>
                        <p class="text-xs text-gray-500">${feedback.user_email}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Type</label>
                        <p class="text-sm text-gray-900">${feedback.feedback_type}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Priority</label>
                        <p class="text-sm text-gray-900">${feedback.priority}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <p class="text-sm text-gray-900">${feedback.status}</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <p class="text-sm text-gray-700 bg-gray-50 p-3 rounded">${feedback.message}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Submitted</label>
                    <p class="text-sm text-gray-500">${new Date(feedback.submitted_date).toLocaleString()}</p>
                </div>
            </div>
        `;
        document.getElementById('feedbackModal').classList.remove('hidden');
    }
}

function closeFeedbackModal() {
    document.getElementById('feedbackModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('feedbackModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeFeedbackModal();
    }
});
</script>
@endsection
