<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'aadhaar_number',
        'mobile_number',
        'email',
        'gender',
        'dob',
        'state',
        'district',
        'address',
        'pension_status',
    ];

    public function pensions()
    {
        return $this->hasMany(CitizenPension::class);
    }
}
