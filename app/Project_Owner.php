<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Project_Owner extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'owner_id', 'project_id'
    ];
}
