<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Post extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['title', 'description' , 'content', 'image', 'published_at', 'category_id',];

//Delete Post image from storage
    public function deleteImage(){
    	Storage::delete($this->image);
    }

    ///Make relations to category
    ///Name of the function IS THE MODEL IN SMALL CASES
    public function category(){
    	return $this->belongsTo(Category::class);

    }
      ///Make relations to tag
    ///Name of the function IS THE MODEL IN SMALL CASES
    public function tags(){
return $this->belongsToMany(Tag::class);
}

//Check if post has tags
//Return bool
public function hasTag($tagId){
return in_array($tagId, $this->tags->pluck('id')->toArray());
}


}
