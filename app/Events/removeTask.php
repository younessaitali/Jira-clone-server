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

class removeTask implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $task, $user, $project_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $board = Board::findOrFail($task->board_id);
        $this->task = $task;
        $this->project_id = $board->project_id;
        $this->user = auth()->user();
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('project.' . $this->project_id);
    }
}
