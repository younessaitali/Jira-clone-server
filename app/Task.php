<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Attributes to guard against mass assignment.
     *
     * @var array
     */

    protected $guarded = [];


    public function board()
    {
        return $this->belongsTo(Board::class);
    }


    public function todos()
    {
        return $this->hasMany(Todos_container::class);
    }
}
