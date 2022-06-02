<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
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
    ];

    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function association()
    {
        return $this->belongsTo(Association::class, 'association_id', 'id');
    }


    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'project_id', 'id')
            ->withDefault();
    }

    public function basket()
    {
        return $this->hasMany(Basket::class, 'project_id', 'id')
            ->withDefault();
    }

}
