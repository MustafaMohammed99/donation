<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'association_id',
        'category_id',
        'title',
        'description',
        'status',
        'num_beneficiaries',
        'current_num_beneficiaries',
        'price_stock',
        'require_amount',
        'received_amount',
        'created_at',
        'start_period',
        'end_period',
        'interval',
    ];


    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function association()
    {
        return $this->belongsTo(Association::class, 'association_id', 'id');
    }

    public function project_stopping()
    {
        return $this->hasOne(StoppingProject::class, 'project_id', 'id');
    }

    public function projects_paths()
    {
        return $this->hasMany(ProjectPath::class, 'project_id', 'id');
    }

    public function monitor_status_of_projects()
    {
        return $this->hasMany(Monitor_status_of_project::class, 'project_id', 'id');
    }

    public function project_notification()
    {
        return $this->hasMany(MobileNotification::class, 'project_id', 'id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'project_id', 'id');
    }

    public function basket()
    {
        return $this->hasMany(Basket::class, 'project_id', 'id');
    }


    public function getRemainingDaysAttribute()
    {
//  remaining_days
        if ($this->status == 'accepted' && $this->end_period) {
            $remaining_days = Carbon::now()->diffInDays(Carbon::parse($this->end_period), false);
        } else {
            $remaining_days = 0;
        }
        return $remaining_days;
    }

    public function getRemainingAmountAttribute()
    {
//  remaining_amount
        return $this->require_amount - $this->received_amount;
    }

    public function getDonationPeriodAttribute()
    {
//  donation_period
        if (($this->status === 'completed' || $this->status === 'completed_partial' || $this->status === 'failed')
            && $this->updated_at && $this->start_period) {
            return Carbon::parse($this->start_period)->diffInDays($this->updated_at);
        }
        return 0;
    }
}
