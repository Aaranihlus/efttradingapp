<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $offer_id;
    public $username;
    public $message;

    public function __construct($offer_id, $username, $message)
    {
        $this->offer_id = $offer_id;
        $this->username = $username;
        $this->message = $message;
        $this->dontBroadcastToCurrentUser();
    }

    public function broadcastOn()
    {
        return new Channel('offers' . $this->offer_id);
    }
}
