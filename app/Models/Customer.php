<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $table = 'customers';

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'start_date', 'end_date',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'start_date', 'end_date', 'created_at', 'updated_at',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function lastBooking()
    {
        return $this->hasOne(Booking::class)->latest();
    }
}
