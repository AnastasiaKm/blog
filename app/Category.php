<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // We are defining this because the plural of the category is different from the expected

    protected $table = 'categories';
    public function posts()
    {
      return $this->hasMany('App\Post');
    }
}
