@extends('layouts.landlord')

@section('landlord-content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white rounded-xl shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-4">
            <h1 class="text-2xl font-bold text-center">
                <i class="fas fa-comments mr-3"></i>Chat with Students
            </h1>
        </div>

        <div class="flex h-[600px]">
            <!-- Chat List Sidebar -->
            <div class="w-80 md:w-1/3 lg:w-1/4 bg-gray-50 border-r border-gray-200 flex flex-col">
                <div class="p-4 bg-white border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-inbox mr-2 text-green-600"></i>Your Conversations
                    </h2>
                </div>

                <div id="chat-list" class="flex-1 overflow-y-auto">
                    @forelse($chats as $chat)
                        <div class="chat-item p-4 cursor-pointer hover:bg-green-50 hover:shadow-md hover:scale-[1.02] transition-all duration-300 border-b border-gray-100 {{ $selectedChat && $selectedChat->chatID == $chat->chatID ? 'bg-green-100 border-l-4 border-l-green-600 shadow-sm' : '' }}" data-chat-id="{{ $chat->chatID }}">
                            <div class="flex items-center space-x-3">
                                @if($chat->student->profileImg)
                                    <img src="{{ asset('storage/' . $chat->student->profileImg) }}" alt="Student" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    @php
                                        $colors = ['bg-red-500', 'bg-green-500', 'bg-yellow-500', 'bg-purple-500', 'bg-pink-500', 'bg-indigo-500', 'bg-gray-500'];
                                        $index = crc32($chat->student->id) % count($colors);
                                        $color = $colors[$index];
                                    @endphp
                                    <div class="w-10 h-10 rounded-full {{ $color }} flex items-center justify-center text-white font-semibold text-sm">
                                        {{ substr($chat->student->userName, 0, 1) }}
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $chat->student->userName }}</h3>
                                    <p class="text-sm text-gray-500">{{ $chat->messages->last() ? Str::limit($chat->messages->last()->messageContent, 30) : 'No messages yet' }}</p>
                                </div>
                                <div class="text-xs text-gray-400">
                                    {{ $chat->messages->last() ? $chat->messages->last()->timeStamp->diffForHumans() : '' }}
                                </div>
                                @if($chat->unreadCount > 0)
                                    <div class="w-3 h-3 bg-green-500 rounded-full ml-2"></div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-gray-500">
                            <i class="fas fa-comments text-4xl mb-4"></i>
                            <p>No conversations yet</p>
                            <p class="text-sm">Students will initiate chats with you</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Chat Messages Area -->
            <div class="flex-1 flex flex-col">
                @if($selectedChat)
                    <!-- Chat Header -->
                    <div class="bg-white border-b border-gray-200 p-4 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            @if($selectedChat->student->profileImg)
                                <img src="{{ asset('storage/' . $selectedChat->student->profileImg) }}" alt="Student" class="w-10 h-10 rounded-full object-cover">
                            @else
                                @php
                                    $colors = ['bg-red-500', 'bg-green-500', 'bg-yellow-500', 'bg-purple-500', 'bg-pink-500', 'bg-indigo-500', 'bg-gray-500'];
                                    $index = crc32($selectedChat->student->id) % count($colors);
                                    $color = $colors[$index];
                                @endphp
                                <div class="w-10 h-10 rounded-full {{ $color }} flex items-center justify-center text-white font-semibold text-sm">
                                    {{ substr($selectedChat->student->userName, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h2 class="font-semibold text-gray-900">{{ $selectedChat->student->userName }}</h2>
                                <p class="text-sm text-gray-500">
                                    @if($selectedChat->requestStatus == 'pending')
                                        Pending Approval
                                    @elseif($selectedChat->requestStatus == 'accepted')
                                        Active Chat
                                    @else
                                        Declined
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            @if($selectedChat->requestStatus == 'pending')
                                <button id="accept-chat" class="bg-green-600 text-white px-3 py-1 rounded-lg hover:bg-green-700 text-sm">
                                    <i class="fas fa-check mr-1"></i>Accept
                                </button>
                                <button id="decline-chat" class="bg-red-600 text-white px-3 py-1 rounded-lg hover:bg-red-700 text-sm">
                                    <i class="fas fa-times mr-1"></i>Decline
                                </button>
                            @else
                                <button id="delete-chat" class="text-red-600 hover:text-red-800 transition-colors duration-200">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Listing Context -->
                    @if($listingContext)
                        <div class="bg-green-50 border-b border-green-200 p-4 hover:bg-green-100 transition-colors duration-200">
                            <div class="flex items-center space-x-3">
                                @if($listingContext->images && count($listingContext->images) > 0)
                                    <img src="{{ asset('storage/' . $listingContext->images[0]) }}" alt="Listing" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-green-600 flex items-center justify-center text-white font-semibold text-sm">
                                        <i class="fas fa-home"></i>
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $listingContext->listingTitle }}</h3>
                                    <p class="text-sm text-gray-600">{{ Str::limit($listingContext->listingDescription, 30) }}</p>
                                    <p class="text-sm font-medium text-green-700">RM {{ number_format($listingContext->price, 2) }}</p>
                                </div>
                                <div class="text-xs text-gray-400">
                                    <i class="fas fa-map-marker-alt mr-1"></i>{{ Str::limit($listingContext->location, 15) }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Messages Scrollable Area -->
                    <div id="messages-container" class="flex-1 overflow-y-auto p-4 space-y-4">
                        @forelse($selectedChat->messages as $message)
                            <div class="flex {{ $message->senderID == auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->senderID == auth()->id() ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-900' }}">
                                    <p>{{ $message->messageContent }}</p>
                                    <p class="text-xs mt-1 {{ $message->senderID == auth()->id() ? 'text-green-200' : 'text-gray-500' }}">
                                        {{ $message->timeStamp->format('M j, g:i A') }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-gray-500 py-8">
                                <i class="fas fa-comments text-4xl mb-4"></i>
                                <p>No messages yet. Start the conversation!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Chat Input -->
                    @if($selectedChat->requestStatus == 'accepted')
                        <div class="bg-white border-t border-gray-200 p-4">
                            <form id="send-message-form" class="flex space-x-2">
                                <input type="text" id="message-input" class="flex-1 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Type your message..." required>
                                <button type="submit" id="send-button" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                    @elseif($selectedChat->requestStatus == 'pending')
                        <div class="bg-yellow-50 border-t border-yellow-200 p-4">
                            <div class="flex items-center space-x-2 text-yellow-800">
                                <i class="fas fa-clock"></i>
                                <p class="text-sm">Accept the chat request to start messaging</p>
                            </div>
                        </div>
                    @else
                        <div class="bg-red-50 border-t border-red-200 p-4">
                            <div class="flex items-center space-x-2 text-red-800">
                                <i class="fas fa-times-circle"></i>
                                <p class="text-sm">This chat request was declined</p>
                            </div>
                        </div>
                    @endif
                @else
                    <div class="flex-1 flex items-center justify-center bg-gray-50">
                        <div class="text-center text-gray-500">
                            <i class="fas fa-comments text-4xl md:text-6xl mb-4"></i>
                            <h3 class="text-xl font-semibold mb-2">Select a conversation</h3>
                            <p>Choose a chat from the sidebar to start messaging</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let selectedChatId = {{ $selectedChat ? $selectedChat->chatID : 'null' }};

    // Chat selection
    document.querySelectorAll('.chat-item').forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('chat', this.dataset.chatId);
                window.location.href = '{{ route("landlord.chat") }}?' + urlParams.toString();
            }, 150);
        });
    });

    // Auto-scroll to bottom
    function scrollToBottom() {
        const messagesContainer = document.getElementById('messages-container');
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    }
    scrollToBottom();

    // Auto-resize textarea
    const messageInput = document.getElementById('message-input');
    if (messageInput) {
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 128) + 'px';
        });
    }

    // Send message
    document.getElementById('send-message-form')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const messageInput = document.getElementById('message-input');
        const message = messageInput.value.trim();
        if (!message) return;

        const sendButton = document.getElementById('send-button');
        sendButton.disabled = true;
        sendButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

        fetch('{{ route("landlord.chat.send", ":chatID") }}'.replace(':chatID', selectedChatId), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        }).then(response => response.json()).then(data => {
            if (data.success) {
                messageInput.value = '';
                const messagesContainer = document.getElementById('messages-container');
                const newMessageDiv = document.createElement('div');
                newMessageDiv.className = 'flex justify-end';
                newMessageDiv.innerHTML = `
                    <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg bg-green-600 text-white">
                        <p>${message}</p>
                        <p class="text-xs mt-1 text-green-200">${new Date().toLocaleString('en-US', { month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit', hour12: true })}</p>
                    </div>
                `;
                messagesContainer.appendChild(newMessageDiv);
                scrollToBottom();
            }
        }).finally(() => {
            sendButton.disabled = false;
            sendButton.innerHTML = '<i class="fas fa-paper-plane"></i>';
        });
    });

    // Accept chat
    document.getElementById('accept-chat')?.addEventListener('click', function() {
        if (confirm('Are you sure you want to accept this chat request?')) {
            fetch('{{ route("landlord.chat.accept", ":chatID") }}'.replace(':chatID', selectedChatId), {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(response => {
                if (response.ok) {
                    location.reload();
                }
            });
        }
    });

    // Decline chat
    document.getElementById('decline-chat')?.addEventListener('click', function() {
        if (confirm('Are you sure you want to decline this chat request?')) {
            fetch('{{ route("landlord.chat.decline", ":chatID") }}'.replace(':chatID', selectedChatId), {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(response => {
                if (response.ok) {
                    location.reload();
                }
            });
        }
    });

    // Delete chat
    document.getElementById('delete-chat')?.addEventListener('click', function() {
        if (confirm('Are you sure you want to delete this chat?')) {
            fetch('{{ route("landlord.chat.delete", ":chatID") }}'.replace(':chatID', selectedChatId), {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(response => {
                if (response.ok) {
                    window.location.href = '{{ route("landlord.chat") }}';
                }
            });
        }
    });
});
</script>
@endsection
