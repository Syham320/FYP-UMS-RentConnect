@extends('layouts.student')

@section('student-content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">My Accommodation Registrations</h1>
    <p class="text-gray-600 text-center mb-8">Manage your accommodation registration forms and track their approval status.</p>

    <!-- Create Post Button -->
    <div class="mb-8 text-right">
        <button id="createPostBtn" class="bg-gradient-to-r from-green-500 to-blue-500 text-white px-8 py-4 rounded-full hover:from-green-600 hover:to-blue-600 transition-all duration-300 transform hover:scale-105 shadow-lg">
            <i class="fas fa-plus mr-2"></i>Create New Post
        </button>
    </div>

    <!-- Categories -->
    <div class="mb-10">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">Categories</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="category-card bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1" data-category="study">
                <div class="flex items-center mb-3">
                    <i class="fas fa-book text-blue-500 text-2xl mr-3"></i>
                    <h3 class="font-bold text-xl text-blue-600">Study Groups</h3>
                </div>
                <p class="text-gray-600">Find study partners and group discussions.</p>
            </div>
            <div class="category-card bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1" data-category="housing">
                <div class="flex items-center mb-3">
                    <i class="fas fa-home text-green-500 text-2xl mr-3"></i>
                    <h3 class="font-bold text-xl text-green-600">Housing & Rentals</h3>
                </div>
                <p class="text-gray-600">Discuss rental tips and housing options.</p>
            </div>
            <div class="category-card bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1" data-category="events">
                <div class="flex items-center mb-3">
                    <i class="fas fa-calendar-alt text-purple-500 text-2xl mr-3"></i>
                    <h3 class="font-bold text-xl text-purple-600">Campus Events</h3>
                </div>
                <p class="text-gray-600">Share and discover upcoming events.</p>
            </div>
        </div>
    </div>

    <!-- Recent Posts -->
    <div class="mb-10">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">Recent Posts</h2>
        <div id="postsContainer" class="space-y-6">
            <!-- Post 1 -->
            <div class="post-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300" data-category="study">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                S
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">Looking for study group for CS101</h3>
                                <p class="text-gray-600">Anyone interested in forming a study group for the upcoming exam?</p>
                            </div>
                        </div>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Study Groups</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <span class="mr-4">By: Sarah Wilson</span>
                        <span class="mr-4">2 hours ago</span>
                        <span id="comments-count-1">5 comments</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4">
                            <button class="like-btn text-gray-500 hover:text-red-500 transition-colors duration-200 flex items-center" data-post="1">
                                <i class="fas fa-heart mr-1"></i>
                                <span class="like-count">12</span>
                            </button>
                            <button class="comment-toggle text-blue-600 hover:text-blue-800 transition-colors duration-200" data-post="1">
                                <i class="fas fa-comment mr-1"></i>Comments
                            </button>
                            <button class="text-gray-600 hover:text-gray-800 transition-colors duration-200">
                                <i class="fas fa-share mr-1"></i>Share
                            </button>
                        </div>
                        <button class="text-red-600 hover:text-red-800 transition-colors duration-200">
                            <i class="fas fa-flag mr-1"></i>Report
                        </button>
                    </div>
                    <div id="comments-1" class="comments-section mt-4 hidden">
                        <div class="border-t pt-4 space-y-3">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-xs">J</div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium">John Doe</p>
                                    <p class="text-sm text-gray-600">I'm in! Let's meet at the library tomorrow.</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-xs">A</div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium">Alice Smith</p>
                                    <p class="text-sm text-gray-600">Count me in too!</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <input type="text" placeholder="Add a comment..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Post 2 -->
            <div class="post-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300" data-category="housing">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                R
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">New rental regulations update</h3>
                                <p class="text-gray-600">What are your thoughts on the recent changes to rental policies?</p>
                            </div>
                        </div>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Housing & Rentals</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <span class="mr-4">By: Robert Chen</span>
                        <span class="mr-4">5 hours ago</span>
                        <span id="comments-count-2">7 comments</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4">
                            <button class="like-btn text-gray-500 hover:text-red-500 transition-colors duration-200 flex items-center" data-post="2">
                                <i class="fas fa-heart mr-1"></i>
                                <span class="like-count">8</span>
                            </button>
                            <button class="comment-toggle text-blue-600 hover:text-blue-800 transition-colors duration-200" data-post="2">
                                <i class="fas fa-comment mr-1"></i>Comments
                            </button>
                            <button class="text-gray-600 hover:text-gray-800 transition-colors duration-200">
                                <i class="fas fa-share mr-1"></i>Share
                            </button>
                        </div>
                        <button class="text-red-600 hover:text-red-800 transition-colors duration-200">
                            <i class="fas fa-flag mr-1"></i>Report
                        </button>
                    </div>
                    <div id="comments-2" class="comments-section mt-4 hidden">
                        <div class="border-t pt-4 space-y-3">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-xs">M</div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium">Mike Johnson</p>
                                    <p class="text-sm text-gray-600">I think it's a good change for transparency.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <input type="text" placeholder="Add a comment..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Post 3 -->
            <div class="post-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300" data-category="events">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-4">
                                L
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">Campus festival next week</h3>
                                <p class="text-gray-600">Who's excited for the annual campus festival? Let's plan some activities!</p>
                            </div>
                        </div>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">Campus Events</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <span class="mr-4">By: Lisa Martinez</span>
                        <span class="mr-4">1 day ago</span>
                        <span id="comments-count-3">9 comments</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4">
                            <button class="like-btn text-gray-500 hover:text-red-500 transition-colors duration-200 flex items-center" data-post="3">
                                <i class="fas fa-heart mr-1"></i>
                                <span class="like-count">15</span>
                            </button>
                            <button class="comment-toggle text-blue-600 hover:text-blue-800 transition-colors duration-200" data-post="3">
                                <i class="fas fa-comment mr-1"></i>Comments
                            </button>
                            <button class="text-gray-600 hover:text-gray-800 transition-colors duration-200">
                                <i class="fas fa-share mr-1"></i>Share
                            </button>
                        </div>
                        <button class="text-red-600 hover:text-red-800 transition-colors duration-200">
                            <i class="fas fa-flag mr-1"></i>Report
                        </button>
                    </div>
                    <div id="comments-3" class="comments-section mt-4 hidden">
                        <div class="border-t pt-4 space-y-3">
                            <div class="flex items-start space-x-3">
                                <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center text-xs">E</div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium">Emma Wilson</p>
                                    <p class="text-sm text-gray-600">Can't wait! Let's meet at the main stage.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <input type="text" placeholder="Add a comment..." class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Announcements Section -->
    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 border-l-4 border-yellow-600 p-6 mb-8 rounded-lg shadow-lg">
        <div class="flex items-center mb-3">
            <i class="fas fa-bullhorn text-white text-2xl mr-3"></i>
            <h3 class="text-xl font-semibold text-white">Official Announcements</h3>
        </div>
        <p class="text-white opacity-90">Important updates on campus housing policies. Check admin announcements for full details.</p>
    </div>
</div>

<!-- Create Post Modal -->
<div id="createPostModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white rounded-xl p-8 w-full max-w-md mx-4">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Create New Post</h2>
        <form id="createPostForm">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" id="postTitle" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                <select id="postCategory" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">Select a category</option>
                    <option value="study">Study Groups</option>
                    <option value="housing">Housing & Rentals</option>
                    <option value="events">Campus Events</option>
                </select>
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea id="postContent" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancelPost" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors duration-200">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">Post</button>
            </div>
        </form>
    </div>
</div>

<script>
// Like functionality
document.querySelectorAll('.like-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const icon = this.querySelector('i');
        const count = this.querySelector('.like-count');
        let currentCount = parseInt(count.textContent);

        if (icon.classList.contains('fas')) {
            icon.classList.remove('fas');
            icon.classList.add('far');
            count.textContent = currentCount - 1;
            this.classList.remove('text-red-500');
            this.classList.add('text-gray-500');
        } else {
            icon.classList.remove('far');
            icon.classList.add('fas');
            count.textContent = currentCount + 1;
            this.classList.remove('text-gray-500');
            this.classList.add('text-red-500');
        }
    });
});

// Comment toggle
document.querySelectorAll('.comment-toggle').forEach(btn => {
    btn.addEventListener('click', function() {
        const postId = this.getAttribute('data-post');
        const commentsSection = document.getElementById(`comments-${postId}`);
        commentsSection.classList.toggle('hidden');
    });
});

// Category filtering
document.querySelectorAll('.category-card').forEach(card => {
    card.addEventListener('click', function() {
        const category = this.getAttribute('data-category');
        const posts = document.querySelectorAll('.post-card');

        // Remove active state from all categories
        document.querySelectorAll('.category-card').forEach(c => c.classList.remove('ring-2', 'ring-blue-500'));
        this.classList.add('ring-2', 'ring-blue-500');

        posts.forEach(post => {
            if (category === 'all' || post.getAttribute('data-category') === category) {
                post.style.display = 'block';
            } else {
                post.style.display = 'none';
            }
        });
    });
});

// Modal functionality
const modal = document.getElementById('createPostModal');
const createBtn = document.getElementById('createPostBtn');
const cancelBtn = document.getElementById('cancelPost');
const form = document.getElementById('createPostForm');

createBtn.addEventListener('click', () => {
    modal.classList.remove('hidden');
});

cancelBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
    form.reset();
});

modal.addEventListener('click', (e) => {
    if (e.target === modal) {
        modal.classList.add('hidden');
        form.reset();
    }
});

form.addEventListener('submit', (e) => {
    e.preventDefault();
    // Simulate posting (in real app, this would send to server)
    alert('Post created successfully! (This is a simulation)');
    modal.classList.add('hidden');
    form.reset();
});
</script>
@endsection
