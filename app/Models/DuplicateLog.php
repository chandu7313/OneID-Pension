<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuplicateLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'citizen_id',
        'duplicate_with_id',
        'status',
    ];

    public function citizen()
    {
        return $this->belongsTo(Citizen::class, 'citizen_id');
    }

    public function duplicateWith()
    {
        return $this->belongsTo(Citizen::class, 'duplicate_with_id');
    }
}
