<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    public function teams()
    {
        return $this->belongsToMany('App\Models\Team');
    }
}
