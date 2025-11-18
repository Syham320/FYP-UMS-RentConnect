@extends('layouts.student')

@section('student-content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">
        @isset($accommodation)
            Edit Accommodation Registration
        @else
            Submit Accommodation Registration
        @endisset
    </h1>
    <p class="text-gray-600 text-center mb-8">
        @isset($accommodation)
            Update your accommodation registration details below.
        @else
            Fill out the form below to register your accommodation.
        @endisset
    </p>

    <div class="bg-white rounded-lg shadow-lg p-8">
        @isset($accommodation)
            <form action="{{ route('student.accommodation.update', $accommodation->registrationID) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
        @else
            <form action="{{ route('student.accommodation.store') }}" method="POST" enctype="multipart/form-data">
        @endisset
            @csrf

            <div class="mb-6">
                <label for="fullName" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <input type="text" id="fullName" name="fullName" value="{{ old('fullName', $accommodation->fullName ?? '') }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="matricNumber" class="block text-sm font-medium text-gray-700 mb-2">Matric Number</label>
                <input type="text" id="matricNumber" name="matricNumber" value="{{ old('matricNumber', $accommodation->matricNumber ?? '') }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address', $accommodation->address ?? '') }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="landlordName" class="block text-sm font-medium text-gray-700 mb-2">Landlord Name</label>
                <input type="text" id="landlordName" name="landlordName" value="{{ old('landlordName', $accommodation->landlordName ?? '') }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="rentalType" class="block text-sm font-medium text-gray-700 mb-2">Rental Type</label>
                <select id="rentalType" name="rentalType" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Rental Type</option>
                    <option value="Single Room" {{ old('rentalType', $accommodation->rentalType ?? '') == 'Single Room' ? 'selected' : '' }}>Single Room</option>
                    <option value="Shared Room" {{ old('rentalType', $accommodation->rentalType ?? '') == 'Shared Room' ? 'selected' : '' }}>Shared Room</option>
                    <option value="Studio" {{ old('rentalType', $accommodation->rentalType ?? '') == 'Studio' ? 'selected' : '' }}>Studio</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="rentalAgreement" class="block text-sm font-medium text-gray-700 mb-2">Rental Agreement (Max 2MB)</label>
                <input type="file" id="rentalAgreement" name="rentalAgreement" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @isset($accommodation)
                    @if($accommodation->rentalAgreement)
                        <p class="mt-2 text-sm text-gray-600">Current file: <a href="{{ asset('storage/' . $accommodation->rentalAgreement) }}" target="_blank" class="text-blue-500 underline">View</a></p>
                    @endif
                @endisset
            </div>

            <div class="mb-8">
                <label for="paymentProof" class="block text-sm font-medium text-gray-700 mb-2">Payment Proof (Max 2MB)</label>
                <input type="file" id="paymentProof" name="paymentProof" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                @isset($accommodation)
                    @if($accommodation->paymentProof)
                        <p class="mt-2 text-sm text-gray-600">Current file: <a href="{{ asset('storage/' . $accommodation->paymentProof) }}" target="_blank" class="text-blue-500 underline">View</a></p>
                    @endif
                @endisset
            </div>

            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-8 rounded-lg transition duration-300 text-lg">
                    @isset($accommodation)
                        Update Registration
                    @else
                        Submit Registration
                    @endisset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
