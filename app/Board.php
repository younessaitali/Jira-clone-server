<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    /**
     * Attributes to guard against mass assignment.
     *
     * @var array
     */

    protected $guarded = [];


    public function Tasks()
    {
        return $this->hasMany(Task::class);
    }


    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
