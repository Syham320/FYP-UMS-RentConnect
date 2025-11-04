@extends('layouts.default')

@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-500 to-purple-600 text-white py-24 text-center">
    <h1 class="text-5xl font-extrabold mb-4 hero-title">Welcome to UMS RentConnect</h1>
    <p class="text-xl max-w-3xl mx-auto">
        Your trusted platform for student housing at Universiti Malaysia Sabah.
        Safe, reliable & community-focused.
    </p>

    <a href="#features" class="mt-8 inline-block bg-white text-blue-600 px-10 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
        Learn More
    </a>
</section>

<!-- Features -->
<section id="features" class="py-20 bg-white">
    <div class="container mx-auto px-4 text-center">

        <h2 class="text-3xl font-bold mb-12 text-gray-800">Why Use UMS RentConnect?</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div>
                <div class="bg-green-100 p-4 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 text-3xl">
                    ✅
                </div>
                <h3 class="font-semibold text-xl">Verified Listings</h3>
                <p class="text-gray-600 mt-2">Avoid scams — every listing is verified.</p>
            </div>

            <div>
                <div class="bg-blue-100 p-4 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 text-3xl">
                    💬
                </div>
                <h3 class="font-semibold text-xl">Direct Communication</h3>
                <p class="text-gray-600 mt-2">Chat directly with landlords.</p>
            </div>

            <div>
                <div class="bg-purple-100 p-4 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4 text-3xl">
                    📝
                </div>
                <h3 class="font-semibold text-xl">Simple Registration</h3>
                <p class="text-gray-600 mt-2">Submit student housing info easily.</p>
            </div>

        </div>
    </div>
</section>

@endsection
