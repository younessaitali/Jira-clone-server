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

    public function projectsTransform($projects)
    {
        $ProjectsList = collect();
        $ProjectsList = $projects->map(function ($project) {
            return [
                'id' => $project->id,
                'title' => $project->title,
                'owner' => $project->owner,
                'start_at' => $project->start_at,
                'end_at' => $project->end_at,
                "created_at" => $project->created_at,
                "updated_at" => $project->updated_at

            ];
        });
        return $ProjectsList;
    }

    public function projectTransform($project)
    {
        return [
            'id' => $project->id,
            'title' => $project->title,
            'owner' => $project->owner,
            'start_at' => $project->start_at,
            'end_at' => $project->end_at,
            "created_at" => $project->created_at,
            "updated_at" => $project->updated_at

        ];
    }
}
