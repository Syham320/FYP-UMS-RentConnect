@extends('layouts.student')

@section('student-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Frequently Asked Questions</h1>
    <p class="text-gray-600 text-center mb-8">Find answers to common questions about using the UMS Rent Connect platform.</p>

    <!-- Search FAQs -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <div class="max-w-md mx-auto">
            <label for="faq-search" class="block text-sm font-medium text-gray-700 mb-2">Search FAQs</label>
            <input type="text" id="faq-search" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Type your question...">
        </div>
    </div>

    <!-- FAQ Categories -->
    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <!-- Getting Started -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Getting Started
            </h2>
            <div class="space-y-3">
                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('gs1')">
                        <span class="font-medium text-gray-900 text-sm">How do I create an account?</span>
                        <svg class="w-4 h-4 text-gray-500 transform transition-transform" id="icon-gs1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-4 pb-3 hidden" id="faq-gs1">
                        <p class="text-gray-600 text-sm">Click on the "Register" button on the homepage and fill in your details including your student ID and university information.</p>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('gs2')">
                        <span class="font-medium text-gray-900 text-sm">What do I need to access rental listings?</span>
                        <svg class="w-4 h-4 text-gray-500 transform transition-transform" id="icon-gs2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-4 pb-3 hidden" id="faq-gs2">
                        <p class="text-gray-600 text-sm">You'll need an approved non-resident declaration to access off-campus rental listings. Submit this through the Accommodation page.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rental Process -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Rental Process
            </h2>
            <div class="space-y-3">
                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('rp1')">
                        <span class="font-medium text-gray-900 text-sm">How do I submit a rental request?</span>
                        <svg class="w-4 h-4 text-gray-500 transform transition-transform" id="icon-rp1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-4 pb-3 hidden" id="faq-rp1">
                        <p class="text-gray-600 text-sm">Browse available listings and click "Request to Rent" on properties that interest you. Your request will be sent to the landlord for approval.</p>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('rp2')">
                        <span class="font-medium text-gray-900 text-sm">How long does approval take?</span>
                        <svg class="w-4 h-4 text-gray-500 transform transition-transform" id="icon-rp2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-4 pb-3 hidden" id="faq-rp2">
                        <p class="text-gray-600 text-sm">Rental requests are typically processed within 1-2 business days. You'll receive a notification once a decision is made.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- More FAQs -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">More Questions</h2>

        <div class="space-y-4">
            <!-- Account & Profile -->
            <div class="border border-gray-200 rounded-lg">
                <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('acc1')">
                    <span class="font-medium text-gray-900">How do I update my profile information?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="icon-acc1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-4 pb-3 hidden" id="faq-acc1">
                    <p class="text-gray-600">Go to your Profile page and click "Edit Profile" to update your personal information, contact details, and preferences.</p>
                </div>
            </div>

            <!-- Documents & Verification -->
            <div class="border border-gray-200 rounded-lg">
                <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('doc1')">
                    <span class="font-medium text-gray-900">What documents do I need for non-resident declaration?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="icon-doc1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-4 pb-3 hidden" id="faq-doc1">
                    <p class="text-gray-600">You'll need: valid student ID, proof of UMS enrollment, identification documents (IC/passport), and proof of non-resident status. All documents must be clear and legible.</p>
                </div>
            </div>

            <!-- Technical Support -->
            <div class="border border-gray-200 rounded-lg">
                <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('tech1')">
                    <span class="font-medium text-gray-900">I'm having trouble accessing the platform</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="icon-tech1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-4 pb-3 hidden" id="faq-tech1">
                    <p class="text-gray-600">Try clearing your browser cache and cookies, or try accessing the platform from a different browser. If the issue persists, contact our support team through the Feedback page.</p>
                </div>
            </div>

            <!-- Landlord Communication -->
            <div class="border border-gray-200 rounded-lg">
                <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('comm1')">
                    <span class="font-medium text-gray-900">How do I contact a landlord?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="icon-comm1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-4 pb-3 hidden" id="faq-comm1">
                    <p class="text-gray-600">Once your rental request is approved, you'll be able to access the landlord's contact information through the Chat feature in your dashboard.</p>
                </div>
            </div>

            <!-- Safety & Security -->
            <div class="border border-gray-200 rounded-lg">
                <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('safe1')">
                    <span class="font-medium text-gray-900">Is my personal information secure?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="icon-safe1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-4 pb-3 hidden" id="faq-safe1">
                    <p class="text-gray-600">Yes, we use industry-standard encryption and security measures to protect your personal information. We never share your data with third parties without your consent.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Support -->
    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
        <h3 class="text-lg font-medium text-blue-800 mb-2">Still need help?</h3>
        <p class="text-blue-700 mb-4">Can't find the answer you're looking for? Our support team is here to help.</p>
        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
            Contact Support
        </button>
    </div>
</div>

<script>
function toggleFAQ(id) {
    const content = document.getElementById('faq-' + id);
    const icon = document.getElementById('icon-' + id);

    if (content.classList.contains('hidden')) {
        content.classList.remove('hidden');
        icon.classList.add('rotate-180');
    } else {
        content.classList.add('hidden');
        icon.classList.remove('rotate-180');
    }
}

// Simple search functionality
document.getElementById('faq-search').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const faqItems = document.querySelectorAll('[id^="faq-"]');

    faqItems.forEach(item => {
        const question = item.previousElementSibling.textContent.toLowerCase();
        const answer = item.textContent.toLowerCase();

        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
            item.closest('.border').style.display = 'block';
        } else {
            item.closest('.border').style.display = 'none';
        }
    });
});
</script>
@endsection
