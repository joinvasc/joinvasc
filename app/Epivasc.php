<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Epivasc extends Model
{   
    use SoftDeletes;

    protected $table = 'epivascs';
    
    /**
     * @return BelongsTo
     */

    protected $fillable = [
        'clinical_history',
        'seizures',
    ];

    /**
     * castable fields.
     *
     * @param array
     */
    protected $casts = [
        'clinical_history'   => 'array',
        'seizures' => 'array',
    ];

    protected $dates = ['deleted_at'];

    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }
}
