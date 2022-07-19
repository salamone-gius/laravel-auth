<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // imposto le condizioni per il mass assignment (protezione dei campi)
    protected $guarded = [];
}
