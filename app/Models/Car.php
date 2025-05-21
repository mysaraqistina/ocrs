<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    protected $fillable = [
        'branch_id',
        'brand',
        'model',
        'type',
        'transmission',
        'status',
        'image',
    ];
}
