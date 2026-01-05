@extends('layouts.admin')

@section('admin-content')
<div class="max-w-6xl mx-auto">
    <h1 class="text-4xl font-bold mb-8 text-center text-gray-800">Forum Community Management</h1>
    <p class="text-gray-600 text-center mb-8">Manage forum posts, comments, and publish official announcements.</p>

    <!-- Tabs for different sections -->
    <div class="mb-6">
        <nav class="flex space-x-4" aria-label="Tabs">
            <button class="tab-button active bg-red-100 text-red-700 px-4 py-2 rounded-lg" data-tab="posts">Forum Posts</button>
            <button class="tab-button bg-gray-100 text-gray-700 px-4 py-2 rounded-lg" data-tab="announcements">Announcements</button>
            <button class="tab-button bg-gray-100 text-gray-700 px-4 py-2 rounded-lg" data-tab="reports">Reported Content</button>
        </nav>
    </div>

    <!-- Forum Posts Tab -->
    <div id="posts-tab" class="tab-content">
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-4">Recent Forum Posts</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Author</th>
                            <th class="px-4 py-2 text-left">Category</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-4 py-2">Dealing with difficult tenants</td>
                            <td class="px-4 py-2">Sarah Wilson (Landlord)</td>
                            <td class="px-4 py-2">Property Management</td>
                            <td class="px-4 py-2"><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Approved</span></td>
                            <td class="px-4 py-2">
                                <button class="text-blue-600 hover:text-blue-800 mr-2">View</button>
                                <button class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</button>
                                <button class="text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2">New rental regulations update</td>
                            <td class="px-4 py-2">Robert Chen (Landlord)</td>
                            <td class="px-4 py-2">Legal & Regulations</td>
                            <td class="px-4 py-2"><span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">Pending</span></td>
                            <td class="px-4 py-2">
                                <button class="text-green-600 hover:text-green-800 mr-2">Approve</button>
                                <button class="text-red-600 hover:text-red-800">Reject</button>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2">Finding affordable housing</td>
                            <td class="px-4 py-2">John Doe (Student)</td>
                            <td class="px-4 py-2">General Discussion</td>
                            <td class="px-4 py-2"><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Approved</span></td>
                            <td class="px-4 py-2">
                                <button class="text-blue-600 hover:text-blue-800 mr-2">View</button>
                                <button class="text-yellow-600 hover:text-yellow-800 mr-2">Edit</button>
                                <button class="text-red-600 hover:text-red-800">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Announcements Tab -->
    <div id="announcements-tab" class="tab-content hidden">
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold">Official Announcements</h2>
                <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                    <i class="fas fa-plus mr-2"></i>Create Announcement
                </button>
            </div>
            <div class="space-y-4">
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold text-lg mb-2">Property Tax Changes</h3>
                    <p class="text-gray-600 mb-2">Important updates regarding property tax regulations...</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <span class="mr-4">Published: 2 days ago</span>
                        <span>By: Admin</span>
                    </div>
                    <div class="mt-2">
                        <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                        <button class="text-red-600 hover:text-red-800">Delete</button>
                    </div>
                </div>
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold text-lg mb-2">New Safety Guidelines</h3>
                    <p class="text-gray-600 mb-2">Updated safety protocols for rental properties...</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <span class="mr-4">Published: 1 week ago</span>
                        <span>By: Admin</span>
                    </div>
                    <div class="mt-2">
                        <button class="text-blue-600 hover:text-blue-800 mr-2">Edit</button>
                        <button class="text-red-600 hover:text-red-800">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reported Content Tab -->
    <div id="reports-tab" class="tab-content hidden">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-semibold mb-4">Reported Content</h2>
            <div class="space-y-4">
                <div class="border rounded-lg p-4 bg-red-50">
                    <h3 class="font-semibold text-lg mb-2">Inappropriate Comment</h3>
                    <p class="text-gray-600 mb-2">Reported comment in post: "Dealing with difficult tenants"</p>
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <span class="mr-4">Reported by: Jane Smith</span>
                        <span>Reason: Harassment</span>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Remove Content</button>
                        <button class="bg-gray-600 text-white px-3 py-1 rounded text-sm">Dismiss Report</button>
                    </div>
                </div>
                <div class="border rounded-lg p-4 bg-yellow-50">
                    <h3 class="font-semibold text-lg mb-2">Spam Post</h3>
                    <p class="text-gray-600 mb-2">Reported post: "Cheap rentals available"</p>
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <span class="mr-4">Reported by: Mike Johnson</span>
                        <span>Reason: Spam</span>
                    </div>
                    <div class="flex space-x-2">
                        <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Remove Content</button>
                        <button class="bg-gray-600 text-white px-3 py-1 rounded text-sm">Dismiss Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            tabButtons.forEach(btn => btn.classList.remove('active', 'bg-red-100', 'text-red-700'));
            tabButtons.forEach(btn => btn.classList.add('bg-gray-100', 'text-gray-700'));

            // Hide all tab contents
            tabContents.forEach(content => content.classList.add('hidden'));

            // Add active class to clicked button
            button.classList.add('active', 'bg-red-100', 'text-red-700');
            button.classList.remove('bg-gray-100', 'text-gray-700');

            // Show corresponding tab content
            const tabId = button.getAttribute('data-tab') + '-tab';
            document.getElementById(tabId).classList.remove('hidden');
        });
    });
});
</script>
@endsection
