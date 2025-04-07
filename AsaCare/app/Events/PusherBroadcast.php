<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $chat_id;
    public string $message;
    
    public function __construct(int $chat_id, string $message)
    {
        $this->chat_id = $chat_id;
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        return [$this->chat_id];
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
