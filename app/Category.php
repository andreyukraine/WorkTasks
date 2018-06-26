<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name', 'parent_id', 'slug',
    ];

    protected $primaryKey = 'id';

    public function childs() {

        return $this->hasMany('App\Category','parent_id','id') ;

    }

    public function tasks()
    {
        return $this->belongsToMany('App\Task');
    }
}
