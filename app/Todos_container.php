<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todos_container extends Model
{

    public function todos()
    {
        return $this->hasMany(Todo::class);
    }

    public function taskk()
    {
        return $this->belongsTo(Task::class);
    }
}
