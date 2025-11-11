# TODO: Add Placeholders and Password Toggle to Register and Login Blades

## Tasks
- [x] Update register.blade.php: Add placeholders to all input fields (name, email, password, confirm password, contact info)
- [x] Update register.blade.php: Add password toggle functionality for password and confirm password fields
- [x] Update login.blade.php: Add placeholders to email and password fields
- [x] Update login.blade.php: Add password toggle functionality for password field

## Landlord Side Navigation Implementation

## Tasks
- [x] Create landlord layout with side navigation (layouts/landlord.blade.php)
- [x] Update landlord dashboard to use new layout (dashboards/landlord.blade.php)
- [x] Add landlord routes for all menu items (routes/web.php)
- [x] Create placeholder views for landlord features:
  - [x] My Listings (landlord/my-listings.blade.php)
  - [x] Rental Requests (landlord/rental-requests.blade.php)
  - [x] Approved Listings (landlord/approved-listings.blade.php)
  - [x] Chat (landlord/chat.blade.php)
  - [x] Community & Forum (landlord/community.blade.php)
  - [x] Feedback (landlord/feedback.blade.php)
  - [x] FAQs (landlord/faqs.blade.php)

# TODO: Implement Student Dashboard Side Navigation

## Tasks
- [x] Create student layout with side navigation (layouts/student.blade.php)
- [x] Create student home view (listings page) in student/home.blade.php
- [x] Add routes for all student features in web.php
- [x] Create placeholder views for all student features:
  - [x] Rental Requests (student/rental-requests.blade.php)
  - [x] Bookmarks (student/bookmarks.blade.php)
  - [x] Search & Filters (student/search.blade.php)
  - [x] Accommodation (student/accommodation.blade.php)
  - [x] Chat (student/chat.blade.php)
  - [x] Community & Forum (student/community.blade.php)
  - [x] Complaint (student/complaint.blade.php)
  - [x] Feedback (student/feedback.blade.php)
  - [x] FAQs (student/faqs.blade.php)
- [x] Update login controller to redirect students to home page after login
- [x] Update sidebar navigation: "Home (Listings)" links to student.home
- [x] Create database migrations for listings, rental requests, and bookmarks tables
