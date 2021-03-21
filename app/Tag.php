<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tag extends Model
{
    use Notifiable;
    //


    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
