<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiskFactors extends Model
{
    use SoftDeletes;

    protected $table = 'risk_factors';

    protected $fillable = [
        'avc',
        'hypertension',
        'diabetes',
        'smoking',
        'alcohol',
        'dyslipidemia',
        'cardiopathy', 
        'antitrombotic',
        'drugs',
        'sedentary',
        'other',
    ];

    protected $casts = [
        'antitrombotic' => 'object',
        'sedentary'     => 'object',
        'drugs'         => 'object',
        'cardiopathy'   => 'object',
        'dyslipidemia'  => 'object',
        'smoking'       => 'object',
        'diabetes'      => 'object',
        'hypertension'  => 'object',
        'avc'           => 'object',
        'alcohol'       => 'object',
    ];

    protected $dates = ['deleted_at'];

    /**
     * @return BelongsTo
     */
    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }
}
