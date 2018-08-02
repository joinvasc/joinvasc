<?php
/**
 *
 * User: Harry
 * Date: 10/01/2017
 */
namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FirstEvent extends BaseModel
{
    use SoftDeletes;
    protected $table = 'first_events';

    /**
     * Fillable fields.
     *
     * @param array
     */
    protected $fillable = [
        'previous',
        'number_of_events',
        'last_event_date',
        'rehab',
        'rehab_details',
        'hospital',
        'hospital_especialities',
        'hmsj_uavc',
    ];

    /**
     * castable fields.
     *
     * @param array
     */
    protected $casts = [
        'rehab_details' => 'array',
    ];
    

    /**
     * Fields which are of date type.
     *
     * @param array
     */
    protected $dates = ['last_event_date', 'deleted_at'];

    /**
     * @return BelongsTo
     */
    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }

    public function setLastEventDateAttribute($value)
    {
        $this->attributes['last_event_date'] = to_date($value, 'd/m/Y');
    }
}
