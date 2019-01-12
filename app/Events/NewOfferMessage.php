<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewOfferMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $offer_id;
    public $username;
    public $recipient_id;

    public function __construct($offer_id, $username, $recipient_id)
    {
      $this->offer_id = $offer_id;
      $this->username = $username;
      $this->recipient_id = $recipient_id;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('new_message_for_user_' . $this->recipient_id);
    }
}
