@extends('layouts.default')

@php $hideDefaultNavbar = true; @endphp

@section('head')
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('navbar')
<!-- Custom Navbar for Student -->
<nav class="ums-navbar">
    <div class="ums-container">
        <div class="ums-nav-content">
            <!-- Logo -->
            <a href="javascript:location.reload()" class="ums-brand">
                <img src="{{ asset('images/profiles/UMSRentConnect_logo.svg') }}"
                    alt="UMS RentConnect Logo" class="ums-logo">
            </a>

            <!-- Search Bar -->
            <div class="flex-1 max-w-md mx-4">
                <form action="{{ route('student.search') }}" method="GET" class="flex">
                    <input type="text" name="query" placeholder="Search listings..." class="flex-1 px-4 py-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600">
                        🔍
                    </button>
                </form>
            </div>

            @auth
                <!-- Authenticated User Nav -->
                <div class="ums-nav-links flex items-center space-x-4">
                    <a href="{{ route('student.bookmarks') }}" class="text-gray-700 hover:text-blue-500 transition duration-200" title="Bookmarks">
                        <i class="fas fa-bookmark text-xl"></i>
                    </a>
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
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Student Menu</h2>
            <nav class="space-y-2 flex-1">
                <a href="{{ route('student.home') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 rounded-lg {{ request()->routeIs('student.home') ? 'bg-blue-200' : '' }}">
                    <i class="fas fa-home mr-2"></i>Home (Listings)
                </a>

                <a href="{{ route('student.rental-requests') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 rounded-lg {{ request()->routeIs('student.rental-requests') ? 'bg-blue-200' : '' }}">
                    <i class="fas fa-file-alt mr-2"></i>Rental Requests
                </a>
                <a href="{{ route('student.accommodation') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 rounded-lg {{ request()->routeIs('student.accommodation') ? 'bg-blue-200' : '' }}">
                    <i class="fas fa-building mr-2"></i>Accommodation
                </a>
                <a href="{{ route('student.chat') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 rounded-lg {{ request()->routeIs('student.chat') ? 'bg-blue-200' : '' }}">
                    <i class="fas fa-comments mr-2"></i>Chat
                </a>
                <a href="{{ route('student.community') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 rounded-lg {{ request()->routeIs('student.community') ? 'bg-blue-200' : '' }}">
                    <i class="fas fa-users mr-2"></i>Community & Forum
                </a>
                <a href="{{ route('student.complaint') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 rounded-lg {{ request()->routeIs('student.complaint') ? 'bg-blue-200' : '' }}">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Complaint
                </a>
                <a href="{{ route('student.feedback') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 rounded-lg {{ request()->routeIs('student.feedback') ? 'bg-blue-200' : '' }}">
                    <i class="fas fa-star mr-2"></i>Feedback
                </a>
                <a href="{{ route('student.faqs') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-100 rounded-lg {{ request()->routeIs('student.faqs') ? 'bg-blue-200' : '' }}">
                    <i class="fas fa-question-circle mr-2"></i>FAQs
                </a>
            </nav>

            <!-- Profile Section at Bottom -->
            <div class="mt-auto pt-6 border-t border-gray-200">
                <a href="{{ route('student.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 rounded-lg {{ request()->routeIs('student.dashboard') ? 'bg-blue-200' : '' }}">
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
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-blue-100 rounded-lg border border-gray-300 hover:border-blue-500 transition duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        @yield('student-content')
    </main>
</div>
@endsection
