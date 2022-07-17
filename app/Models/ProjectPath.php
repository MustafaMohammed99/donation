<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectPath extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'project_id',
        ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

}
