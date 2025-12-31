# TODO: Implement Message Privacy

## Plan
1. Modify the Message model to use Laravel's 'encrypted' cast for messageContent to ensure messages are encrypted in the database and not visible as plain text.
2. Test that messages are properly encrypted/decrypted.

## Steps
- [x] Update Message model to add 'encrypted' cast for messageContent
- [x] Verify encryption works by checking database and application display

# TODO: Complete Landlord Chat Interface

## Plan
1. Complete the landlord chat view with full chat functionality including message display, input form, and JavaScript interactions.
2. Add accept/decline functionality for pending chat requests.
3. Ensure proper styling and user experience matching the student chat interface.

## Steps
- [x] Complete the landlord chat.blade.php view with messages area, input form, and JavaScript
- [x] Add accept/decline buttons for pending chats
- [x] Implement JavaScript for chat operations (send, accept, decline, delete)
- [x] Test the complete landlord chat functionality
