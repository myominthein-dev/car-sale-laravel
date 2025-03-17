<x-app-layout>

    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $conversation->subject }}
                    </h2>
                    <a href="{{ route('messages.index') }}" class="text-blue-600 hover:text-blue-800">
                        Back to Messages
                    </a>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-medium">Car Details</h3>
                            <div class="flex items-center mt-2">
                                <img src="{{ asset('storage/car_images/' . $conversation->car->primaryImage->image_path) }}"
                                    alt="{{ $conversation->car->title }}" class="w-16 h-16 object-cover rounded">
                                <div class="ml-4">
                                    <p class="font-medium">{{ $conversation->car->title }}</p>
                                    <p class="text-gray-600">${{ number_format($conversation->car->price, 0) }}</p>
                                </div>
                            </div>
                        </div>

                        <div id="sms-container" data-id="{{ Auth::id() }}" class="space-y-4  mb-6">
                            @foreach ($messages as $message)
                                <div class="flex {{ $message->user_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                                    <div
                                        class="max-w-lg {{ $message->user_id === Auth::id() ? 'bg-blue-100' : 'bg-gray-100' }} rounded-lg p-4">
                                        <div class="flex items-center mb-2">
                                            <span class="font-medium">{{ $message->user->name }}</span>
                                            <span
                                                class="text-xs text-gray-500 ml-2">{{ $message->created_at->format('M d, Y H:i') }}</span>
                                        </div>
                                        <p>{{ $message->body }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <form action="{{ route('messages.reply', $conversation) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Reply</label>
                                <textarea name="message" id="message" rows="4"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="Type your message here..." required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                                    Send Reply
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script type="module">
            document.addEventListener('DOMContentLoaded', () => {
                const smsContainer = document.querySelector('#sms-container');

                Echo.private('message').listen('SendMessage', (e) => {
                    if (!e.latestMessage) return;

                    
                    // Convert Laravel timestamp to JavaScript Date
                    const createdAt = new Date(e.latestMessage.created_at);
                    const formattedDate = createdAt.toLocaleString('en-US', {
                        month: 'short', // "Mar"
                        day: '2-digit', // "07"
                        year: 'numeric', // "2025"
                        hour: '2-digit', // "14"
                        minute: '2-digit', // "30"
                        hour12: false, // Use 24-hour format
                    });

                    // Get Auth user ID from a meta tag (set in Blade template)
                    const authUserId = document.querySelector('meta[name="auth-id"]').content;

                    // Generate the message bubble with correct alignment
                    const template = `
            <div class="flex ${e.latestMessage.user_id == authUserId ? 'justify-end' : 'justify-start'}">
                <div class="max-w-lg ${e.latestMessage.user_id == authUserId ? 'bg-blue-100' : 'bg-gray-100'} rounded-lg p-4">
                    <div class="flex items-center mb-2">
                        <span class="font-medium">${e.replier}</span>
                        <span class="text-xs text-gray-500 ml-2">${formattedDate}</span>
                    </div>
                    <p>${e.latestMessage.body}</p>
                </div>
            </div>`;

                    // Append the new message to the container

                    if (smsContainer.getAttribute('data-id') != e.latestMessage.user_id) {
                    smsContainer.insertAdjacentHTML('beforeend', template);
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
