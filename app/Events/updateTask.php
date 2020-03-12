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

class updateTask implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $task, $user, $project_id, $refresh, $oldBoardId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($task, $oldBoard)
    {
        $this->oldBoardId = $oldBoard->id;
        $this->refresh = false;

        if ($oldBoard->id != $task->board_id)
            $this->refresh = true;

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
