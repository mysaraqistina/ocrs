<?php

namespace App\Models;
use App\Models\Car;
use App\Models\Admin;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function bookings()
    {
        // Each branch has many bookings through its cars
        return $this->hasManyThrough(
            Booking::class,   // The related model
            Car::class,       // The intermediate model
            'branch_id',      // Foreign key on cars table
            'car_id',         // Foreign key on bookings table
            'id',             // Local key on branches table
            'id'              // Local key on cars table
        );
    }

    protected $fillable = [
        'name',
        'location',
    ];
}
