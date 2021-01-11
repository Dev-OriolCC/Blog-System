<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    // PROVIDE FILLABLE PROPERTIE
    protected $fillable = [ 'name' ];

    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
