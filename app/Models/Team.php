<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{   
    public function leagues()
    {
        return $this->belongsToMany('App\Models\League');
    }
}
