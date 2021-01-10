<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // PROVIDE FILLABLE PROPERTIE
    protected $fillable = [ 'name' ];


    // Creating Relationship to the Post DB
    public function posts(){
        return $this->hasMany(Post::class);
    }
}
