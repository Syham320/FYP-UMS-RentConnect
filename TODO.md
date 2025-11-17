# TODO: Separate Inline CSS from Blade Templates

## Overview
The Laravel project has some inline CSS in Blade templates that needs to be moved to external CSS files for better maintainability and organization.

## Identified Inline CSS Issues
1. **Auth Pages (login.blade.php, register.blade.php)**: Inline `style="top: 1.5rem;"` on password toggle buttons.
2. **Landlord Approved Listings**: Inline style on "No Image" placeholder div.
3. **Admin Layout**: Inline styles for navbar in admin.blade.php.

## Plan
- [ ] Move password toggle button styles to `public/css/utils/auth.css`
- [ ] Move "No Image" placeholder style to `public/css/landlord/approved-listings.css`
- [ ] Move admin navbar styles to `public/css/admin/navbar.css`
- [ ] Update Blade templates to use CSS classes instead of inline styles
- [ ] Ensure all CSS files are properly linked in layouts

## Files to Edit
- resources/views/auth/login.blade.php
- resources/views/auth/register.blade.php
- resources/views/landlord/approved-listings.blade.php
- resources/views/layouts/admin.blade.php
- public/css/utils/auth.css (create if needed)
- public/css/landlord/approved-listings.css
- public/css/admin/navbar.css

## Followup Steps
- [ ] Test all pages to ensure styles are applied correctly
- [ ] Verify no inline styles remain in Blade templates
- [ ] Run project to check for any styling issues
