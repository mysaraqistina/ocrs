<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    protected $fillable = [
        'branch_id',
        'name',
        'email',
        'password',
    ];
}
