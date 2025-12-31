<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;

class ChatController extends Controller
{
    public function studentIndex(Request $request)
    {
        $studentId = auth()->id();

        // Get all chats for the student
        $chats = Chat::where('studentID', $studentId)->with(['landlord', 'listing', 'messages'])->get();

        // Add unread count to each chat
        foreach ($chats as $chat) {
            $chat->unreadCount = $chat->getUnreadCountForUser($studentId);
        }

        // Get selected chat if provided
        $selectedChat = null;
        $listingContext = null;
        if ($request->has('chat')) {
            $selectedChat = Chat::where('chatID', $request->chat)
                ->where('studentID', $studentId)
                ->with(['landlord', 'messages.sender', 'listing'])
                ->first();

            // Get listing context if chat has a listing
            if ($selectedChat && $selectedChat->listing) {
                $listingContext = $selectedChat->listing;
            }
        }

        // Get all landlords for initiate chat
        $landlords = User::where('userRole', 'Landlord')->get();

        // Get pre-filled message if provided
        $prefilledMessage = $request->get('prefilled_message');

        return view('student.chat', compact('chats', 'selectedChat', 'landlords', 'prefilledMessage', 'listingContext'));
    }

    public function landlordIndex(Request $request)
    {
        $landlordId = auth()->id();

        // Get all chats for the landlord
        $chats = Chat::where('landlordID', $landlordId)->with(['student', 'listing', 'messages'])->get();

        // Add unread count to each chat
        foreach ($chats as $chat) {
            $chat->unreadCount = $chat->getUnreadCountForUser($landlordId);
        }

        // Get selected chat if provided
        $selectedChat = null;
        $listingContext = null;
        if ($request->has('chat')) {
            $selectedChat = Chat::where('chatID', $request->chat)
                ->where('landlordID', $landlordId)
                ->with(['student', 'messages.sender', 'listing'])
                ->first();

            // Get listing context if chat has a listing
            if ($selectedChat && $selectedChat->listing) {
                $listingContext = $selectedChat->listing;
            }
        }

        return view('landlord.chat', compact('chats', 'selectedChat', 'listingContext'));
    }

    public function initiateRequest(Request $request)
    {
        $request->validate([
            'landlord_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000'
        ]);

        $studentId = auth()->id();

        // Check if chat already exists
        $existingChat = Chat::where('studentID', $studentId)
            ->where('landlordID', $request->landlord_id)
            ->first();

        if ($existingChat) {
            return response()->json(['success' => false, 'message' => 'Chat already exists']);
        }

        // Create new chat
        $chat = Chat::create([
            'studentID' => $studentId,
            'landlordID' => $request->landlord_id,
            'requestStatus' => 'pending'
        ]);

        // Create initial message
        Message::create([
            'chatID' => $chat->chatID,
            'senderID' => $studentId,
            'messageContent' => $request->message
        ]);

        return response()->json(['success' => true, 'chat_id' => $chat->chatID]);
    }

    public function initiateFromListing(Request $request, $listingId)
    {
        $studentId = auth()->id();

        // Get listing to find landlord
        $listing = \App\Models\Listing::findOrFail($listingId);
        $landlordId = $listing->user_id;

        // Check if chat already exists
        $existingChat = Chat::where('studentID', $studentId)
            ->where('landlordID', $landlordId)
            ->first();

        if ($existingChat) {
            // Redirect to existing chat with listing context
            return redirect()->route('student.chat', ['chat' => $existingChat->chatID, 'from_listing' => $listingId]);
        }

        // Create new chat
        $chat = Chat::create([
            'studentID' => $studentId,
            'landlordID' => $landlordId,
            'listing_id' => $listingId,
            'requestStatus' => 'pending'
        ]);

        // Create initial message with simple interest prompt
        $prefilledMessage = "I'm interested in this room/house. Can we discuss the details?";

        // Create initial message
        Message::create([
            'chatID' => $chat->chatID,
            'senderID' => $studentId,
            'messageContent' => $prefilledMessage
        ]);

        // Redirect to the new chat with listing context
        return redirect()->route('student.chat', ['chat' => $chat->chatID, 'from_listing' => $listingId]);
    }

    public function studentSendMessage(Request $request, $chatID)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $studentId = auth()->id();

        // Verify chat belongs to student
        $chat = Chat::where('chatID', $chatID)
            ->where('studentID', $studentId)
            ->firstOrFail();

        // Create message
        Message::create([
            'chatID' => $chatID,
            'senderID' => $studentId,
            'messageContent' => $request->message
        ]);

        return response()->json(['success' => true]);
    }

    public function studentDeleteChat($chatID)
    {
        $studentId = auth()->id();

        // Find and delete chat
        $chat = Chat::where('chatID', $chatID)
            ->where('studentID', $studentId)
            ->firstOrFail();

        // Clear session messages for this chat
        session()->forget('chat_messages.' . $chatID);

        $chat->delete();

        return response()->json(['success' => true]);
    }

    public function landlordSendMessage(Request $request, $chatID)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $landlordId = auth()->id();

        // Verify chat belongs to landlord
        $chat = Chat::where('chatID', $chatID)
            ->where('landlordID', $landlordId)
            ->firstOrFail();

        // Create message
        Message::create([
            'chatID' => $chatID,
            'senderID' => $landlordId,
            'messageContent' => $request->message
        ]);

        return response()->json(['success' => true]);
    }

    public function landlordDeleteChat($chatID)
    {
        $landlordId = auth()->id();

        // Find and delete chat
        $chat = Chat::where('chatID', $chatID)
            ->where('landlordID', $landlordId)
            ->firstOrFail();

        $chat->delete();

        return response()->json(['success' => true]);
    }

    public function landlordAcceptChat($chatID)
    {
        $landlordId = auth()->id();

        // Find and update chat
        $chat = Chat::where('chatID', $chatID)
            ->where('landlordID', $landlordId)
            ->where('requestStatus', 'pending')
            ->firstOrFail();

        $chat->update(['requestStatus' => 'accepted']);

        return response()->json(['success' => true]);
    }

    public function landlordDeclineChat($chatID)
    {
        $landlordId = auth()->id();

        // Find and update chat
        $chat = Chat::where('chatID', $chatID)
            ->where('landlordID', $landlordId)
            ->where('requestStatus', 'pending')
            ->firstOrFail();

        $chat->update(['requestStatus' => 'declined']);

        return response()->json(['success' => true]);
    }
}
