<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientOrigin extends BaseModel
{
    use SoftDeletes;
    protected $table = 'patient_origins';

    protected $fillable = [
        'ecocarotidas_doctor',
        'ecocarotidas_date',
        'immediate_origin',
    ];

    protected $dates = ['ecocarotidas_date', 'deleted_at' ];

    /**
     * @return BelongsTo
     */
    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }
    public function setEcoratidasDateAttribute($value)
    {
        $this->attributes['ecocarotidas_date'] = to_date($value, 'd/m/Y - H:i');
    }
}
