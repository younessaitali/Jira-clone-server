<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Attributes to guard against mass assignment.
     *
     * @var array
     */

    protected $guarded = [];

    public function Boards()
    {
        return $this->hasMany(Board::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function owners()
    {
        return $this->belongsToMany(User::class, 'project__owners', 'project_id', 'owner_id')->withTimestamps();
    }
}
