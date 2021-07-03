<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $dates = ['created_at', 'updated_at', 'last_login','expires_at'];
    
    
    public function generateCode()
    {
        $this->timestamps = false;
        $this->last_login =now();
        $this->code = rand(100000, 999999);
        $this->expires_at = now()->addMinutes(30);
        $this->save();
    }

    public function resetCode()
    {
        $this->timestamps = false;
        $this->code = null;
        $this->expires_at = null;
        $this->save();
    }
}
