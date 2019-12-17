<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todos_container extends Model
{
    /**
     * Attributes to guard against mass assignment.
     *
     * @var array
     */

    protected $guarded = [];

    public function todo_list()
    {
        return $this->hasMany(Todo::class, 'container_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
