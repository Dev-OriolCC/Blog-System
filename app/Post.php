<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'title', 'description', 'content', 'published_at', 'image', 'category_id'
    ];

    public function DeleteImage(){
        Storage::delete($this->image);
    }
    // Relationship with Category (SQL)
    public function category(){
        return $this->belongsTo(Category::class);
    }
    // Relation with Tags
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
