<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;

class Admin extends User
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image_path',
        'address',
        'is_super_admin',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
    ];



    public function admin_monitor_status_of_projects()
    {
        return $this->hasMany(Monitor_status_of_project::class, 'admin_id', 'id');
    }
}
