<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Active extends Model
{   
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activations';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
