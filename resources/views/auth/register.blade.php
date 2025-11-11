@extends('layouts.default')

@section('head')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center"><i class="fas fa-user-plus mr-2"></i>Register</h2>

        @if($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" id="successModal">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm mx-auto">
                    <h3 class="text-lg font-semibold text-green-600 mb-4">Success!</h3>
                    <p class="text-gray-700 mb-4">{{ session('success') }}</p>
                    <button onclick="closeModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">OK</button>
                </div>
            </div>
        @endif

        <script>
            function closeModal() {
                document.getElementById('successModal').style.display = 'none';
                window.location.href = '{{ route("login") }}';
            }

            function previewImage(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('imagePreview');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '#';
                    preview.classList.add('hidden');
                }
            }

            function selectRole(role) {
                document.getElementById('userRole').value = role;
                // Remove selected class from all buttons
                document.querySelectorAll('.role-btn').forEach(btn => {
                    btn.classList.remove('border-blue-500', 'border-green-500', 'bg-blue-50', 'bg-green-50');
                    btn.classList.add('border-gray-300');
                });
                // Add selected class to clicked button
                const clickedBtn = document.getElementById(role.toLowerCase() + 'Btn');
                if (role === 'Student') {
                    clickedBtn.classList.remove('border-gray-300');
                    clickedBtn.classList.add('border-blue-500', 'bg-blue-50');
                } else if (role === 'Landlord') {
                    clickedBtn.classList.remove('border-gray-300');
                    clickedBtn.classList.add('border-green-500', 'bg-green-50');
                }
            }

            function togglePassword(fieldId) {
                const input = document.getElementById(fieldId);
                const icon = document.getElementById(fieldId === 'password' ? 'passwordIcon' : 'passwordConfirmationIcon');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'fas fa-eye-slash w-5 h-5';
                } else {
                    input.type = 'password';
                    icon.className = 'fas fa-eye w-5 h-5';
                }
            }

            // Auto-show modal if success message exists
            document.addEventListener('DOMContentLoaded', function() {
                const successModal = document.getElementById('successModal');
                if (successModal) {
                    successModal.style.display = 'flex';
                }
            });
        </script>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <!-- Profile Image Preview at Top -->
            <div class="mb-6 text-center">
                <img id="imagePreview" src="#" alt="Profile Preview" class="w-24 h-24 rounded-full mx-auto mb-2 hidden object-cover border-2 border-gray-300">
                <div class="text-sm text-gray-500 mb-2">Profile Picture Preview</div>
            </div>

            <div class="mb-4">
                <label for="userName" class="block text-gray-700">Name</label>
                <input type="text" id="userName" name="userName" placeholder="Enter your name" class="w-full px-3 py-2 border rounded-lg" required>
            </div>
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
            <div class="mb-4 relative">
                <label for="password_confirmation" class="block text-gray-700">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" class="w-full px-3 py-2 border rounded-lg pr-10" required>
                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700" style="top: 1.5rem;">
                    <i id="passwordConfirmationIcon" class="fas fa-eye w-5 h-5"></i>
                </button>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 mb-3">What are you?</label>
                <div class="flex gap-4 justify-center">
                    <button type="button" onclick="selectRole('Student')" id="studentBtn" class="role-btn px-6 py-3 border-2 border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition duration-200">
                        Student
                    </button>
                    <button type="button" onclick="selectRole('Landlord')" id="landlordBtn" class="role-btn px-6 py-3 border-2 border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition duration-200">
                        Landlord
                    </button>
                </div>
                <input type="hidden" id="userRole" name="userRole" required>
            </div>
            <!-- Profile Image Upload under Role -->
            <div class="mb-4">
                <label for="profileImg" class="block text-gray-700">Profile Image (Optional)</label>
                <input type="file" id="profileImg" name="profileImg" class="w-full px-3 py-2 border rounded-lg" accept="image/*" onchange="previewImage(event)">
                <p class="text-sm text-gray-500 mt-1">Upload a profile picture. Preview will appear above.</p>
            </div>
            <div class="mb-4">
                <label for="contactInfo" class="block text-gray-700">Contact Info</label>
                <input type="text" id="contactInfo" name="contactInfo" placeholder="Enter your contact information" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">Register</button>
        </form>

        <p class="mt-4 text-center">Already have an account? <a href="{{ route('login') }}" class="text-blue-500">Login</a></p>
    </div>
</div>
@endsection
