<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitor_status_of_project extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'admin_id',
        'project_id',
        'before_edit',
        'status',
        'created_at',
    ];
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];


    public function project_monitor()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function admin_project()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
