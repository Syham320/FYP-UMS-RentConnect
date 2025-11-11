@extends('layouts.default')

@section('head')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center"><i class="fas fa-sign-in-alt mr-2"></i>Login</h2>

        @if($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label for="userEmail" class="block text-gray-700">Email</label>
                <input type="email" id="userEmail" name="userEmail" placeholder="Enter your email" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
            <div class="mb-4 relative">
                <label for="password" class="block text-gray-700">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" class="w-full px-3 py-2 border rounded-lg pr-10" required>
                <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700" style="top: 1.5rem;">
                    <i id="passwordIcon" class="fas fa-eye w-5 h-5"></i>
                </button>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Login</button>
        </form>

        <script>
            function togglePassword(fieldId) {
                const input = document.getElementById(fieldId);
                const icon = document.getElementById('passwordIcon');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'fas fa-eye-slash w-5 h-5';
                } else {
                    input.type = 'password';
                    icon.className = 'fas fa-eye w-5 h-5';
                }
            }
        </script>

        <p class="mt-4 text-center">Don't have an account? <a href="{{ route('register') }}" class="text-blue-500">Register</a></p>
    </div>
</div>
@endsection
