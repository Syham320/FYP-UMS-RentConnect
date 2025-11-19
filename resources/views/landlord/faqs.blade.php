@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Frequently Asked Questions</h1>
    <p class="text-gray-600 text-center mb-8">Find answers to common questions about using the UMS Rent Connect platform.</p>

    <!-- FAQ Categories -->
    @if($faqs->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($faqs as $category => $categoryFaqs)
            <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ $category }}
                </h2>
                <div class="space-y-3">
                    @foreach($categoryFaqs as $index => $faq)
                        <div class="border border-gray-200 rounded-lg">
                            <button class="w-full px-4 py-3 text-left focus:outline-none focus:bg-gray-50 flex justify-between items-center" onclick="toggleFAQ('{{ $category }}-{{ $index }}')">
                                <span class="font-medium text-gray-900 text-sm" data-original-text="{{ $faq->faqQuestion }}">{{ $faq->faqQuestion }}</span>
                                <svg class="w-4 h-4 text-green-500 transform transition-transform" id="icon-{{ $category }}-{{ $index }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="px-4 pb-3 hidden" id="faq-{{ $category }}-{{ $index }}">
                                <p class="text-gray-600 text-sm" data-original-text="{{ $faq->faqAnswer }}">{{ $faq->faqAnswer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <h3 class="text-xl font-semibold text-gray-800 mb-2">No FAQs available</h3>
            <p class="text-gray-600">FAQs are being updated. Please check back later.</p>
        </div>
    @endif

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
</script>
@endsection
