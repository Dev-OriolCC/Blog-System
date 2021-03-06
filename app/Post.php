<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    // Date Variable
    protected $dates = ['published_at'];
    
    protected $fillable = [
        'title', 'description', 'content', 'published_at', 'image', 'category_id', 'user_id'
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
    // CHECK TAGS ID
    public function hasTag($tagId){
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }
    //RELATION WITH USER
    public function user(){
        return $this->belongsTo(User::class);
    }
    // LARAVEL SCOPE SEARCHED
    public function scopeSearched($query){
        $search = request()->query('search');

        if(!$search){
            return $query->publish();
        }

        return $query->publish()->where('title', 'LIKE', "%{$search}%");
    }
    // LARAVEL SCOPE PUBLISH
    public function scopePublish($query){
        return $query->where('published_at', '<=', now());
    }

}
