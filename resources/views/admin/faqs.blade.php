@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Manage FAQs</h1>
        <button onclick="openAddFaqModal()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
            <i class="fas fa-plus mr-2"></i>Add New FAQ
        </button>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
    @endif

    @php
        // Mock data for FAQs
        $faqs = collect([
            (object) [
                'id' => 1,
                'user_role' => 'Student',
                'category' => 'Getting Started',
                'question' => 'How do I create an account?',
                'answer' => 'Click on the "Register" button on the homepage and fill in your details including your student ID and university information.',
                'is_active' => true
            ],
            (object) [
                'id' => 2,
                'user_role' => 'Student',
                'category' => 'Getting Started',
                'question' => 'What do I need to access rental listings?',
                'answer' => 'You\'ll need an approved non-resident declaration to access off-campus rental listings. Submit this through the Accommodation page.',
                'is_active' => true
            ],
            (object) [
                'id' => 3,
                'user_role' => 'Student',
                'category' => 'Rental Process',
                'question' => 'How do I submit a rental request?',
                'answer' => 'Browse available listings and click "Request to Rent" on properties that interest you. Your request will be sent to the landlord for approval.',
                'is_active' => true
            ],
            (object) [
                'id' => 4,
                'user_role' => 'Student',
                'category' => 'Rental Process',
                'question' => 'How long does approval take?',
                'answer' => 'Rental requests are typically processed within 1-2 business days. You\'ll receive a notification once a decision is made.',
                'is_active' => true
            ],
            (object) [
                'id' => 5,
                'user_role' => 'Landlord',
                'category' => 'Property Management',
                'question' => 'How do I add a new rental listing?',
                'answer' => 'Go to your dashboard and click "Create Listing". Fill in all the property details, upload photos, and set your rental terms.',
                'is_active' => true
            ],
            (object) [
                'id' => 6,
                'user_role' => 'Landlord',
                'category' => 'Rental Requests',
                'question' => 'How do I review student rental requests?',
                'answer' => 'Check your "Rental Requests" section in the dashboard. You can approve or reject requests and communicate directly with interested students.',
                'is_active' => true
            ],
            (object) [
                'id' => 7,
                'user_role' => 'Student',
                'category' => 'Account & Profile',
                'question' => 'How do I update my profile information?',
                'answer' => 'Go to your Profile page and click "Edit Profile" to update your personal information, contact details, and preferences.',
                'is_active' => true
            ]
        ]);
    @endphp

    @if($faqs->count())
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Answer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($faqs as $faq)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($faq->user_role === 'Student') bg-blue-100 text-blue-800
                                    @elseif($faq->user_role === 'Landlord') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $faq->user_role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($faq->category === 'Getting Started') bg-blue-100 text-blue-800
                                    @elseif($faq->category === 'Rental Process') bg-green-100 text-green-800
                                    @elseif($faq->category === 'Property Management') bg-orange-100 text-orange-800
                                    @elseif($faq->category === 'Rental Requests') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $faq->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $faq->question }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500 truncate max-w-xs">{{ Str::limit($faq->answer, 80) }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($faq->is_active) bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                    {{ $faq->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button onclick="openEditFaqModal({{ $faq->id }})" class="text-blue-600 hover:text-blue-900 mr-2">Edit</button>
                                <form method="POST" action="#" class="inline">
                                    @csrf
                                    <input type="hidden" name="faq_id" value="{{ $faq->id }}">
                                    <button type="submit" name="action" value="toggle" class="text-yellow-600 hover:text-yellow-900 mr-2">
                                        {{ $faq->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                                <form method="POST" action="#" class="inline">
                                    @csrf
                                    <input type="hidden" name="faq_id" value="{{ $faq->id }}">
                                    <button type="submit" name="action" value="delete" class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Are you sure you want to delete this FAQ?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No FAQs found</h3>
            <p class="text-gray-600">There are currently no FAQs in the system.</p>
        </div>
    @endif
</div>

<!-- Add/Edit FAQ Modal -->
<div id="faqModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900" id="modalTitle">Add New FAQ</h3>
                <button onclick="closeFaqModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <form id="faqForm" method="POST" action="#">
                @csrf
                <input type="hidden" name="faq_id" id="faqId">
                <div class="space-y-4">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="user_role" class="block text-sm font-medium text-gray-700">User Role</label>
                                <select name="user_role" id="user_role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Student">Student</option>
                                    <option value="Landlord">Landlord</option>
                                </select>
                            </div>
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <select name="category" id="category" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Getting Started">Getting Started</option>
                                    <option value="Rental Process">Rental Process</option>
                                    <option value="Property Management">Property Management</option>
                                    <option value="Rental Requests">Rental Requests</option>
                                    <option value="Account & Profile">Account & Profile</option>
                                    <option value="Documents & Verification">Documents & Verification</option>
                                    <option value="Technical Support">Technical Support</option>
                                    <option value="Landlord Communication">Landlord Communication</option>
                                    <option value="Safety & Security">Safety & Security</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                        <input type="text" name="question" id="question" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="answer" class="block text-sm font-medium text-gray-700">Answer</label>
                        <textarea name="answer" id="answer" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" required></textarea>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">Active</label>
                    </div>
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" onclick="closeFaqModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">Save FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openAddFaqModal() {
    document.getElementById('modalTitle').textContent = 'Add New FAQ';
    document.getElementById('faqId').value = '';
    document.getElementById('user_role').value = 'Student';
    document.getElementById('category').value = 'Getting Started';
    document.getElementById('question').value = '';
    document.getElementById('answer').value = '';
    document.getElementById('is_active').checked = true;
    document.getElementById('faqModal').classList.remove('hidden');
}

function openEditFaqModal(faqId) {
    // Mock FAQ data - in real app this would come from server
    const faqs = @json($faqs)
    const faq = faqs.find(f => f.id === faqId);

    if (faq) {
        document.getElementById('modalTitle').textContent = 'Edit FAQ';
        document.getElementById('faqId').value = faq.id;
        document.getElementById('user_role').value = faq.user_role;
        document.getElementById('category').value = faq.category;
        document.getElementById('question').value = faq.question;
        document.getElementById('answer').value = faq.answer;
        document.getElementById('is_active').checked = faq.is_active;
        document.getElementById('faqModal').classList.remove('hidden');
    }
}

function closeFaqModal() {
    document.getElementById('faqModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('faqModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeFaqModal();
    }
});
</script>
@endsection
