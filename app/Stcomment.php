<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stcomment extends Model
{
  protected $fillable = [
   'user_id', 'body', 'status_id'
  ];

  public function status()
  {
  return $this->belongsTo('App\Status');
  }

  public function user() {
  return $this->belongsTo('App\Models\User');
  }

}
