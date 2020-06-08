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

    public function isTrusted(){
        return $this->is_trusted;
    }
    public function info()
    {
        return $this->hasOne(Info::class,'user_id');
    }

    public function validation(){
        return $this->hasOne(Validation::class,'user_id');
    }
    public function sendApiEmailVerificationNotification()
    {
        $this->notify(new VerifyApiEmailNotification);
    }

    public function items()
    {
        return $this->hasMany(Item::class,'user_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class,'user_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class,'user_id');
    }
    public function services()
    {
        return $this->hasMany(Service::class,'user_id');
    }

    public function notifications()
    {
       return $this->hasMany(Notification::class,'user_id');
    }

    public function interests(){
        return $this->hasMany(Interest::class,'user_id');
    }

    public function deals(){
        return $this->hasMany(Deal::class,'buyer_id');
    }
}
