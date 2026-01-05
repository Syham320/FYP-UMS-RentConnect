@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Submit Feedback</h1>
    <p class="text-gray-600 text-center mb-8">We value your feedback! Help us improve the UMS RentConnect platform by sharing your thoughts, suggestions, or reporting any issues you've encountered.</p>

    <div class="bg-white rounded-lg shadow-lg p-8">
        @if(session('success'))
            <div class="mb-6 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('landlord.feedback.store') }}" class="space-y-6" onsubmit="return confirm('Are you sure you want to submit this feedback?');">
            @csrf
            <div>
                <label for="feedbackType" class="block text-sm font-medium text-gray-700 mb-2">Feedback Type</label>
                <select name="feedbackType" id="feedbackType" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Select Type</option>
                    <option value="Suggestion">Suggestion</option>
                    <option value="Complaint">Complaint</option>
                    <option value="Bug">Bug Report</option>
                </select>
            </div>

            <div>
                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                <input type="text" name="subject" id="subject" required maxlength="100" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Brief subject of your feedback">
            </div>

            <div>
                <label for="feedbackText" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                <textarea name="feedbackText" id="feedbackText" required maxlength="255" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Describe your feedback in detail"></textarea>
            </div>

            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Priority (Optional)</label>
                <select name="priority" id="priority" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                    <option value="High">High</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 text-lg">
                    Submit Feedback
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
