<?php

namespace App\Http\Controllers;

use App\Events\Notify;
use App\Events\SendMessage;
use App\Models\Car;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
   

    public function index()
    {
        $userId = Auth::id();
        
        $conversations = Conversation::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['latestMessage', 'car', 'sender', 'receiver'])
            ->latest()
            ->get();
            
        return view('messages.index', compact('conversations'));
    }

    public function show(Conversation $conversation)
    {
        // Check if user is part of this conversation
        if ($conversation->sender_id !== Auth::id() && $conversation->receiver_id !== Auth::id()) {
            abort(403);
        }

        // Mark messages as read
        $conversation->messages()
            ->where('user_id', '!=', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = $conversation->messages()
            ->with('user')
            ->orderBy('created_at')
            ->get();

            //broadcast(new SendMessage('GG win'));
        return view('messages.show', compact('conversation', 'messages'));
    }

    public function create(Request $request)
    {
        $car = Car::findOrFail($request->car_id);
        
        return view('messages.create', compact('car'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'message' => 'required|string',
            'subject' => 'nullable|string|max:255',
        ]);

        $car = Car::findOrFail($request->car_id);
        $senderId = Auth::id();
        $receiverId = $car->user_id;

        // Don't allow messaging yourself
        if ($senderId === $receiverId) {
            return back()->with('error', 'You cannot message yourself.');
        }

        // Check if conversation already exists
        $conversation = Conversation::where(function ($query) use ($senderId, $receiverId, $car) {
            $query->where('sender_id', $senderId)
                  ->where('receiver_id', $receiverId)
                  ->where('car_id', $car->id);
        })->orWhere(function ($query) use ($senderId, $receiverId, $car) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $senderId)
                  ->where('car_id', $car->id);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'car_id' => $car->id,
                'sender_id' => $senderId,
                'receiver_id' => $receiverId,
                'subject' => $request->subject ?? "Inquiry about {$car->title}",
            ]);
        }

        // Create message
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => $senderId,
            'body' => $request->message,
        ]);
        $conversationToEvent = $conversation;

        broadcast(new SendMessage($message, $conversationToEvent));

        return redirect()->route('messages.show', $conversation)
            ->with('success', 'Message sent successfully!');
    }

    public function reply(Request $request, Conversation $conversation)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // Check if user is part of this conversation
        if ($conversation->sender_id !== Auth::id() && $conversation->receiver_id !== Auth::id()) {
            abort(403);
        }

        // Create message
        $latestMessage = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => Auth::id(),
            'body' => $request->message,
        ]);

        $replier = Auth::user()->name;


        
        $message = Message::where('user_id',Auth::id())->where('is_read','0')->get();

        
        $conversationToEvent = Conversation::where('sender_id',Auth::id())->orWhere('receiver_id',Auth::id())->first();
        broadcast(new SendMessage($message, $conversationToEvent, $latestMessage, $replier));
        

        return redirect()->route('messages.show', $conversation)
            ->with('success', 'Reply sent successfully!');
    }
}

