<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  public function category()
  {
    return $this->belongsTo('App\Category');
  }

  public function tags()
  {
    // The last 3 params are optional if we use the naming
    // conventions of laravel
    return $this->belongsToMany('App\Tag', 'post_tag',
                                'post_id', 'tag_id');
  }

  public function comments()
  {
    return $this->hasMany('App\Comment');
  }

}
