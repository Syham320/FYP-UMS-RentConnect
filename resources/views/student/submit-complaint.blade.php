@extends('layouts.student')

@section('student-content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Submit Complaint</h1>
    <p class="text-gray-600 text-center mb-8">Report any issues or concerns you have encountered on the UMS RentConnect platform. Your feedback helps us maintain a safe and reliable environment.</p>

    <div class="bg-white rounded-lg shadow-lg p-8">
        @if(session('success'))
            <div class="mb-6 text-green-700 bg-green-100 p-4 rounded">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('student.complaint.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="complaintCategory" class="block text-sm font-medium text-gray-700 mb-2">Complaint Category</label>
                <select name="complaintCategory" id="complaintCategory" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="">Select Category</option>
                    <option value="Safety">Safety</option>
                    <option value="Fraud">Fraud</option>
                    <option value="Facilities">Facilities</option>
                </select>
            </div>

            <div>
                <label for="complaintDescription" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="complaintDescription" id="complaintDescription" required maxlength="255" rows="6" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Describe your complaint in detail"></textarea>
                <p class="text-sm text-gray-500 mt-1">Maximum 255 characters</p>
            </div>

            <div>
                <label for="complaintFile" class="block text-sm font-medium text-gray-700 mb-2">Attachment (Optional)</label>
                <input type="file" name="complaintFile" id="complaintFile" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                <p class="text-sm text-gray-500 mt-1">Accepted formats: JPG, JPEG, PNG, PDF, DOC, DOCX. Max size: 2MB</p>
            </div>

            <div class="text-center">
                <button type="submit" onclick="return confirm('Are you sure you want to submit this complaint?');" class="bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 text-lg">
                    Submit Complaint
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
