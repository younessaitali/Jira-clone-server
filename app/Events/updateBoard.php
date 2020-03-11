<?php

namespace App\Events;

use App\Board;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class updateBoard implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $board;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($board)
    {
        $this->board = $board;
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('project' . $this->board->project_id);
    }
}
