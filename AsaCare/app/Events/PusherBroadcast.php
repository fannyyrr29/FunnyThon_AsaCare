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

    public int $consultation_id;
    public string $message;
    
    public function __construct(int $consultation_id, string $message)
    {
        $this->consultation_id = $consultation_id;
        $this->message = $message;
    }

    public function broadcastOn(): array
    {
        return [$this->consultation_id];
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
