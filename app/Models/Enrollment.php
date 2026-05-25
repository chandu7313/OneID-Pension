<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollment extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'enrollment_id';

    protected $fillable = [
        'citizen_id',
        'scheme_id',
        'enrollment_number',
        'enrollment_date',
        'pension_amount',
        'status',
        'duplicate_flag',
        'fraud_score',
        'verification_level',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'pension_amount' => 'decimal:2',
        'duplicate_flag' => 'boolean',
        'fraud_score' => 'integer',
        'verification_level' => 'integer',
    ];

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(Citizen::class, 'citizen_id', 'citizen_id');
    }

    public function scheme(): BelongsTo
    {
        return $this->belongsTo(PensionScheme::class, 'scheme_id', 'scheme_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(PensionPayment::class, 'enrollment_id', 'enrollment_id');
    }
}
