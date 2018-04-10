<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use App\Traits\TraitEmail;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use TraitEmail;
    
    /**
     * The attributes that determines what type of guard should use model in roles. 
     *
     * @var string
     */
    protected $guard_name = 'api';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id', 'nick', 'nick_game', 'skype', 'email', 'password', 'points'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'team_id', 'password', 'remember_token', 'activation_token'
    ];

    /**
     * Set password attribute to be always hash
     */
    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
}
