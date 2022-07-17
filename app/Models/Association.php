<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;


class Association extends User
{
    use HasFactory, Notifiable;

    protected  $fillable =[ // الي بدي اسمح الهم
        'name',
        'address',
        'email',
        'password',
        'image_path',
        'remember_token',
        'image_path',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'association_id', 'id');
    }

}
