@extends('layouts.default')

@php $hideDefaultNavbar = true; @endphp

@section('head')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('navbar')
<!-- Custom Navbar for Landlord -->
<nav class="ums-navbar">
    <div class="ums-container">
        <div class="ums-nav-content">
            <!-- Logo -->
            <a href="javascript:location.reload()" class="ums-brand">
                <img src="{{ asset('images/profiles/UMSRentConnect_logo.svg') }}"
                    alt="UMS RentConnect Logo" class="ums-logo">
            </a>

            @auth
                <!-- Authenticated User Nav -->
                <div class="ums-nav-links">
                    Hi, {{ Auth::user()->userName }}!
                </div>
            @endauth

        </div>
    </div>
</nav>
@endsection

@section('content')

<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg flex flex-col min-h-screen">
        <div class="p-6 flex flex-col flex-1">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Landlord Menu</h2>
            <nav class="space-y-2 flex-1">

                <a href="{{ route('landlord.my-listings') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg {{ request()->routeIs('landlord.my-listings') ? 'bg-green-200' : '' }}">
                    <i class="fas fa-list mr-2"></i>My Listings
                </a>
                <a href="{{ route('landlord.rental-requests') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg {{ request()->routeIs('landlord.rental-requests') ? 'bg-green-200' : '' }}">
                    <i class="fas fa-file-alt mr-2"></i>Rental Requests
                </a>
                <a href="{{ route('landlord.approved-listings') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg {{ request()->routeIs('landlord.approved-listings') ? 'bg-green-200' : '' }}">
                    <i class="fas fa-check-circle mr-2"></i>Approved Listings
                </a>
                <a href="{{ route('landlord.chat') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg {{ request()->routeIs('landlord.chat') ? 'bg-green-200' : '' }}">
                    <i class="fas fa-comments mr-2"></i>Chat
                </a>
                <a href="{{ route('landlord.community') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg {{ request()->routeIs('landlord.community') ? 'bg-green-200' : '' }}">
                    <i class="fas fa-users mr-2"></i>Community & Forum
                </a>
                <a href="{{ route('landlord.feedback') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg {{ request()->routeIs('landlord.feedback') ? 'bg-green-200' : '' }}">
                    <i class="fas fa-star mr-2"></i>Feedback
                </a>
                <a href="{{ route('landlord.faqs') }}" class="block px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg {{ request()->routeIs('landlord.faqs') ? 'bg-green-200' : '' }}">
                    <i class="fas fa-question-circle mr-2"></i>FAQs
                </a>
            </nav>

            <!-- Profile Section at Bottom -->
            <div class="mt-auto pt-6 border-t border-gray-200">
                <a href="{{ route('landlord.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-green-100 rounded-lg {{ request()->routeIs('landlord.dashboard') ? 'bg-green-200' : '' }}">
                    <div class="flex-shrink-0 mr-3">
                        @if(Auth::user()->profileImg)
                            <img src="{{ asset('storage/' . Auth::user()->profileImg) }}" alt="Profile" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                                <span class="text-xs text-gray-600">{{ substr(Auth::user()->userName, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->userName }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->userEmail }}</p>
                    </div>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-100 rounded-lg border border-gray-300 hover:border-green-500 transition duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        {{-- place page-specific styles inside main to avoid earlier layout conflicts --}}
        @yield('page-styles')
        @yield('landlord-content')
    </main>
</div>
@endsection
