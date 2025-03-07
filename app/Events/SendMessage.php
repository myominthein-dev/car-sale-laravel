<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $conversation;
    public $latestMessage;
    public $replier;
    /**
     * Create a new event instance.
     */
    public function __construct($message, $conversationToEvent , $latestMessage = null, $replier = null)
    {
        $this->message = $message;
        $this->conversation = $conversationToEvent;
        $this->latestMessage = $latestMessage;
        $this->replier = $replier;
    }

    

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */

    public function broadcastWith () {
        return [
            'message' => $this->message,
            'conversation' => $this->conversation,
            'latestMessage' => $this->latestMessage,
            'replier' => $this->replier
        ];
    }
    

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('message');
    }
}
