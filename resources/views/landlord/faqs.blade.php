@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Frequently Asked Questions</h1>
    <p class="text-gray-600 text-center mb-8">Find answers to common questions about using the UMS Rent Connect platform.</p>

    <!-- Search FAQs -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <div class="max-w-md mx-auto">
            <label for="faq-search" class="block text-sm font-medium text-gray-700 mb-2">Search FAQs</label>
            <input type="text" id="faq-search" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Type your question...">
        </div>
    </div>

    <!-- FAQ Categories -->
    <div class="grid md:grid-cols-2 gap-6 mb-8">
        <!-- Getting Started -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Getting Started
            </h2>
            <div class="space-y-3">
                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('gs1')">
                        <span class="font-medium text-gray-900 text-sm">How do I create a landlord account?</span>
                        <svg class="w-4 h-4 text-gray-500 transform transition-transform" id="icon-gs1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-4 pb-3 hidden" id="faq-gs1">
                        <p class="text-gray-600 text-sm">Click on the "Register" button on the homepage and select "Landlord" as your account type. You'll need to provide identification and property ownership documents.</p>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('gs2')">
                        <span class="font-medium text-gray-900 text-sm">What do I need to list a property?</span>
                        <svg class="w-4 h-4 text-gray-500 transform transition-transform" id="icon-gs2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-4 pb-3 hidden" id="faq-gs2">
                        <p class="text-gray-600 text-sm">You'll need property ownership documents, clear photos of the property, and accurate details about location, pricing, and amenities. All listings must be approved by administrators.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Listing Management -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Listing Management
            </h2>
            <div class="space-y-3">
                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('lm1')">
                        <span class="font-medium text-gray-900 text-sm">How do I create a new listing?</span>
                        <svg class="w-4 h-4 text-gray-500 transform transition-transform" id="icon-lm1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-4 pb-3 hidden" id="faq-lm1">
                        <p class="text-gray-600 text-sm">Go to your dashboard and click "Create Listing". Fill in all required details including property information, pricing, and upload clear photos. Submit for admin approval.</p>
                    </div>
                </div>

                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('lm2')">
                        <span class="font-medium text-gray-900 text-sm">How long does listing approval take?</span>
                        <svg class="w-4 h-4 text-gray-500 transform transition-transform" id="icon-lm2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="px-4 pb-3 hidden" id="faq-lm2">
                        <p class="text-gray-600 text-sm">Listings are typically reviewed within 1-3 business days. You'll receive a notification once your listing is approved or if additional information is needed.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- More FAQs -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">More Questions</h2>

        <div class="space-y-4">
            <!-- Rental Requests -->
            <div class="border border-gray-200 rounded-lg">
                <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('rr1')">
                    <span class="font-medium text-gray-900">How do I manage rental requests?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="icon-rr1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-4 pb-3 hidden" id="faq-rr1">
                    <p class="text-gray-600">Access the Rental Requests page from your dashboard. You can view all requests for your properties, review student information, and accept or decline requests.</p>
                </div>
            </div>

            <!-- Student Verification -->
            <div class="border border-gray-200 rounded-lg">
                <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('sv1')">
                    <span class="font-medium text-gray-900">How do I verify student information?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="icon-sv1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-4 pb-3 hidden" id="faq-sv1">
                    <p class="text-gray-600">All students are verified through the university system. You can view their student ID and enrollment status in their rental request details.</p>
                </div>
            </div>

            <!-- Payment & Contracts -->
            <div class="border border-gray-200 rounded-lg">
                <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('pc1')">
                    <span class="font-medium text-gray-900">How are payments handled?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="icon-pc1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-4 pb-3 hidden" id="faq-pc1">
                    <p class="text-gray-600">Payments are handled directly between you and the tenant. We recommend using secure payment methods and keeping records of all transactions.</p>
                </div>
            </div>

            <!-- Communication -->
            <div class="border border-gray-200 rounded-lg">
                <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('comm1')">
                    <span class="font-medium text-gray-900">How do I communicate with potential tenants?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="icon-comm1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-4 pb-3 hidden" id="faq-comm1">
                    <p class="text-gray-600">Once you accept a rental request, you'll gain access to the tenant's contact information and can communicate through the platform's chat system.</p>
                </div>
            </div>

            <!-- Safety & Legal -->
            <div class="border border-gray-200 rounded-lg">
                <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('safe1')">
                    <span class="font-medium text-gray-900">What legal requirements should I be aware of?</span>
                    <svg class="w-5 h-5 text-gray-500 transform transition-transform" id="icon-safe1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="px-4 pb-3 hidden" id="faq-safe1">
                    <p class="text-gray-600">Ensure all rental agreements comply with local laws. We recommend having written contracts and keeping records of all communications and payments.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Support -->
    <div class="mt-8 bg-green-50 border border-green-200 rounded-lg p-6 text-center">
        <h3 class="text-lg font-medium text-green-800 mb-2">Still need help?</h3>
        <p class="text-green-700 mb-4">Can't find the answer you're looking for? Our support team is here to help.</p>
        <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-6 rounded-lg transition duration-300">
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
