<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMS RentConnect</title>

    <!-- Tailwind -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/utils/base.css') }}">

    @yield('head')

</head>

<script>
window.addEventListener("scroll", () => {
    const navbar = document.querySelector(".navbar");
    navbar.classList.toggle("scrolled", window.scrollY > 10);
});

function toggleDropdown() {
    const menu = document.getElementById('dropdownMenu');
    menu.classList.toggle('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('userDropdown');
    const menu = document.getElementById('dropdownMenu');
    if (!dropdown.contains(event.target)) {
        menu.classList.add('hidden');
    }
});
</script>


<body class="bg-gray-100">

    @yield('navbar')
    @if(!isset($hideDefaultNavbar) || !$hideDefaultNavbar)
    <nav class="ums-navbar">
        <div class="ums-container">
            <div class="ums-nav-content">

                <!-- Logo -->
                <a href="javascript:location.reload()" class="ums-brand">
                    <img src="{{ asset('images/profiles/UMSRentConnect_logo.svg') }}"
                        alt="UMS RentConnect Logo" class="ums-logo">
                </a>

                @auth
                    <!-- Authenticated User Nav with Dropdown -->
                    <div class="ums-nav-links relative">
                        <button class="ums-link dropdown-toggle" id="userDropdown" onclick="toggleDropdown()">
                            Hi, {{ Auth::user()->userName }}! ▼
                        </button>
                        <div class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-20 hidden" id="dropdownMenu">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Update Profile</a>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Guest Nav -->
                    <div class="ums-nav-links">
                        <a href="{{ route('login') }}" class="ums-link">Login</a>
                        <a href="{{ route('register') }}" class="ums-btn-primary">Register</a>
                    </div>
                @endauth

            </div>
        </div>
    </nav>
    @endif



    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-white text-center py-6 mt-10">
        <p>&copy; {{ date('Y') }} UMS RentConnect. All Rights Reserved.</p>
    </footer>

</body>
</html>
