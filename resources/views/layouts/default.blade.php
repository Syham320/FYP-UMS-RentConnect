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


</head>

<script>
window.addEventListener("scroll", () => {
    const navbar = document.querySelector(".navbar");
    navbar.classList.toggle("scrolled", window.scrollY > 10);
});
</script>


<body class="bg-gray-100">

    <nav class="ums-navbar">
    <div class="ums-container">
        <div class="ums-nav-content">

            <!-- Logo -->
            <a href="/" class="ums-brand">
                <img src="{{ asset('images/profiles/UMSRentConnect_logo.svg') }}" 
                    alt="UMS RentConnect Logo" class="ums-logo">
            </a>

            <!-- Links -->
            <div class="ums-nav-links">
                <a href="{{ route('login') }}" class="ums-link">Login</a>
                <a href="{{ route('register') }}" class="ums-btn-primary">Register</a>
            </div>

        </div>
    </div>
</nav>



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
