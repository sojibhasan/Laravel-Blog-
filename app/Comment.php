<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    public function reply()
    {
        return $this->hasMany('App\Comment', 'p_id');
    }
}
