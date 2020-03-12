<?php

namespace App\Jira\Transformers;

class BoardTransformer extends Transformer
{
    public function transform($board)
    {
        $tasks = collect();

        $tasks = $board->tasks->map(function ($task) {

            $task->push($task->todos->map(function ($todos) {
                $todos->push($todos->todo_list);
                return $todos;
            }));
            return $task;
        });
        return [
            'id' => $board->id,
            'project_id' => $board->project_id,
            'sort' => $board->sort,
            'title' => $board->title,
            'tasks' => $tasks,
        ];
    }
}
