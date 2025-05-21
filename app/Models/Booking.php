<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected $fillable = [
        'car_id',
        'customer_id',
        'start_date',
        'end_date',
        'status',
    ];
}
