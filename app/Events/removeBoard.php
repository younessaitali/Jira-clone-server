<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class removeBoard implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $board, $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($board)
    {
        $this->dontBroadcastToCurrentUser();
        $this->user = auth()->user();
        $this->board = $board;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('project.' . $this->board->project_id);
    }
}
