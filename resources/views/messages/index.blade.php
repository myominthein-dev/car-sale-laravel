<x-app-layout>
   

   @section('content')
   <div >
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl mb-10  mt-5 text-gray-800 leading-tight">
            {{ __('My Messages') }}
        </h2>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                @if($conversations->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500">You don't have any messages yet.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($conversations as $conversation)
                            @php
                                $otherUser = $conversation->sender_id == Auth::id() 
                                    ? $conversation->receiver 
                                    : $conversation->sender;
                                $unreadCount = $conversation->unreadMessagesCount(Auth::id());
                            @endphp
                            <a href="{{ route('messages.show', $conversation) }}" class="block">
                                <div class="border rounded-lg p-4 hover:bg-gray-50 transition flex justify-between items-center">
                                    <div>
                                        <div class="flex items-center">
                                            <h3 class="font-medium">{{ $otherUser->name }}</h3>
                                            @if($unreadCount > 0)
                                                <span class="ml-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full">
                                                    {{ $unreadCount }}
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600">{{ $conversation->subject }}</p>
                                        <p class="text-sm text-gray-500">
                                            Re: {{ $conversation->car->title }}
                                        </p>
                                        @if($conversation->latestMessage)
                                            <p class="text-sm text-gray-500 mt-1 truncate">
                                                {{ $conversation->latestMessage->body }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="text-xs text-gray-400">
                                        {{ $conversation->updated_at->diffForHumans() }}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
   @endsection
</x-app-layout>

