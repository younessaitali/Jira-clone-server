<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /**
     * Attributes to guard against mass assignment.
     *
     * @var array
     */

    protected $guarded = [];



    public function todos()
    {
        return $this->belongsTo(Todos_container::class);
    }
}
