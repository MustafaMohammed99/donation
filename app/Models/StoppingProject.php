<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoppingProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'association_id',
        'reason_stopping',
        'status',
        'created_at',
        'updated_at',

    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
