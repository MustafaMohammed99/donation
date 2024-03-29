<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function factories()
    {
        return $this->hasMany(Favorite::class, 'user_id', 'id');
    }

    public function basket()
    {
        return $this->hasMany(Basket::class, 'user_id', 'id');
    }


    public function routeNotificationForFcm($notification = null)
    {
        return $this->deviceTokens()->pluck('token')->toArray();
    }

    public function deviceTokens()
    {
        return $this->hasMany(DeviceToken::class,'user_id','id');
    }

    public function userNotifications()
    {
        return $this->hasMany(MobileNotification::class,'user_id','id');
    }
}
