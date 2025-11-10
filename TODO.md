# TODO: Implement User Registration, Login, and Profile Management

## Step 1: Update Database Schema
- [ ] Create a new migration to modify the users table: add userRole (ENUM: 'Student', 'Landlord', 'Admin'), contactInfo (VARCHAR 50, nullable), profileImg (VARCHAR 255, nullable). Rename name to userName, email to userEmail if needed. Ensure password is hashed.
- [ ] Run the migration to update the database.

## Step 2: Update User Model
- [ ] Modify app/Models/User.php: Update fillable attributes to include userName, userEmail, userRole, contactInfo, profileImg. Add casts for userRole if necessary. Ensure password is hidden.

## Step 3: Create Authentication Controllers
- [ ] Create app/Http/Controllers/Auth/LoginController.php for handling login logic.
- [ ] Create app/Http/Controllers/Auth/RegisterController.php for handling registration logic.
- [ ] Create app/Http/Controllers/Auth/LogoutController.php for handling logout.

## Step 4: Create Profile Management Controller
- [ ] Create app/Http/Controllers/ProfileController.php for updating profile info and deleting account (for Students and Landlords).

## Step 5: Create Role-Based Middleware
- [ ] Create app/Http/Middleware/RoleMiddleware.php to check user roles and redirect accordingly.
- [ ] Register the middleware in app/Http/Kernel.php or bootstrap/app.php (for Laravel 11).

## Step 6: Update Routes
- [ ] Update routes/web.php: Define routes for login, register, logout, profile update, delete account. Use middleware for role-based access. Define home routes for each role (e.g., /student/dashboard, /landlord/dashboard, /admin/dashboard).

## Step 7: Create Views
- [ ] Create resources/views/auth/login.blade.php: Form for email and password.
- [ ] Create resources/views/auth/register.blade.php: Form for userName, userEmail, password, confirm password, userRole (dropdown), contactInfo, profileImg (file upload).
- [ ] Create resources/views/profile/edit.blade.php: Form to update profile info.
- [ ] Create resources/views/dashboards/student.blade.php: Main page for Students.
- [ ] Create resources/views/dashboards/landlord.blade.php: Main page for Landlords.
- [ ] Create resources/views/dashboards/admin.blade.php: Main page for Admins (with user management if needed, but focus on basic for now).

## Step 8: Handle File Uploads
- [ ] Ensure profileImg upload is handled securely in controllers, store in public/images/profiles/.

## Step 9: Implement Security Measures
- [ ] Ensure passwords are hashed using bcrypt.
- [ ] Add validation in controllers for inputs.
- [ ] Use CSRF protection in forms.
- [ ] Implement session-based authentication.

## Step 10: Test and Verify
- [ ] Test registration: User registers, data saved, hashed password.
- [ ] Test login: User logs in, redirected to role-based page.
- [ ] Test profile update: User updates info, changes saved.
- [ ] Test account deletion: Students/Landlords can delete own account, logged out.
- [ ] Ensure no privacy invasion: Only necessary data stored, no tracking beyond required.

## Step 11: Final Checks
- [ ] Ensure all files are in correct folders.
- [ ] Verify interconnections: Models, Controllers, Routes, Views.
- [ ] Run the application and check for errors.

## Additional Feature: Update Navigation Bar After Login
- [x] Modify resources/views/layouts/default.blade.php to show authenticated user nav: logo, "Hi [userName]", and a dropdown with "Update Profile" and "Logout" options.
- [x] Ensure the nav changes conditionally based on authentication status.
- [x] Add JavaScript for dropdown toggle and close on outside click.

## Enhance Student Dashboard
- [x] Update resources/views/dashboards/student.blade.php to display profile picture, userName, userEmail, contactInfo in a cooler layout.
- [x] Remove role display.
- [x] Style the dashboard with cards or sections for better appearance.

## Add Close Button to Edit Profile
- [x] Add an "x" close button to resources/views/profile/edit.blade.php that redirects back to the appropriate dashboard based on user role.

## Modify Registration Form
- [x] Restore profile image upload with preview functionality at the top of the form.
- [x] Update app/Http/Controllers/Auth/RegisterController.php to handle profile image upload.
- [x] Add success popup/modal after successful registration.

## Update Landlord Dashboard
- [x] Apply the same design and styling as the Student dashboard to resources/views/dashboards/landlord.blade.php.

## Update Registration Form Role Selection
- [x] Replace dropdown with button selection for "What are you?" (Student/Landlord) with visual feedback.
