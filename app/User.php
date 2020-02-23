<?php

namespace App;

use App\Notifications\VerifyApiEmailNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Notifications\passwordResetNotification;

class User extends Authenticatable implements  MustVerifyEmail
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function info()
    {
        return $this->hasOne(info::class);
    }

    public function sendApiEmailVerificationNotification()
    {
        $this->notify(new VerifyApiEmailNotification); // my notification
    }
    
}
