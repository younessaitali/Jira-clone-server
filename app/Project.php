<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function Boards()
    {
        return $this->hasMany(Board::class);
    }

    public function owners()
    {
        return $this->belongsToMany(User::class);
    }
}
