<?php

namespace App\Jira\Transformers;

class ProjectTransformer extends Transformer
{
    public function transform($project)
    {
        // $boards = $project->boards;
        $boards = collect();
        $boards = $project->boards->map(function ($board) {
            $board->push($board->tasks->map(function ($task) {

                $task->push($task->todos->map(function ($todos) {
                    $todos->push($todos->todo_list);
                    return $todos;
                }));
                return $task;
            }));
            return $board;
        });
        return [
            'id' => $project->id,
            'title' => $project->title,
            'start_at' => $project->start_at,
            'end_at' => $project->end_at,
            'owner' => $project->owner,
            'owners' => $project->owners,
            'boards' => $boards,
        ];
    }
}
