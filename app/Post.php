<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
  'category_id',
  'photo_id',
  'user_id',
  'slug',
  'title',
  'body'
  ];

  public function user()
  {
  return $this->belongsTo('App\Models\User');
  }

  public function photo()
  {
  return $this->belongsTo('App\Photo');
  }

  public function category()
  {
  return $this->belongsTo('App\Category');
  }

  public function comments()
  {
  return $this->hasMany('App\Comment');
  }

  public function tags()
  {
  return $this->belongsToMany('App\Tag');
  }

  public function getTagListAttribute()
  {
  return $this->tags->lists('id');
  }

}
