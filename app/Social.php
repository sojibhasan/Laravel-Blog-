<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Social extends Model
{
    use Notifiable;
    protected $fillable = [
        'name', 'class', 'link'
    ];
}
