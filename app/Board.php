<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public function Tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
