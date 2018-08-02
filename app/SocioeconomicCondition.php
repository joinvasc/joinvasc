<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocioeconomicCondition extends BaseModel
{
    use SoftDeletes;

    protected $table = 'socioeconomic_conditions';

    protected $fillable = [
        'schooling',
        'child_health',
        'healthcenter_attendance',
        'piped_water',
        'paved_street',
        'assets',
        'social_class',
    ];

    protected $casts = [
        'assets'   => 'array',
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
