<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'user_id', 'project_id', 'title', 'body', 'is_read',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
