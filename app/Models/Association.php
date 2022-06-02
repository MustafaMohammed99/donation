<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Foundation\Auth\User;


class Association extends User
{
    use HasFactory;

    protected  $fillable =[ // الي بدي اسمح الهم
        'name',
        'address',
        'email',
        'password',
        'image_path',
        'remember_token',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'association_id', 'id');
    }

}
