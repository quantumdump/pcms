<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
     ///Make relations to category
    ///Name of the function IS THE MODEL IN SMALL CASES
  public function posts(){
return $this->belongsToMany(Post::class);
}




protected $fillable = ['name'];

}
