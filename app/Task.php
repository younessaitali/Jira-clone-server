<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function Board()
    {
        return $this->belongsTo(Board::class);
    }

    
}
