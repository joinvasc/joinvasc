<?php
/**
 *
 * User: Harry
 * Date: 10/01/2017
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurrentEvent extends BaseModel
{   
    use SoftDeletes;
    protected $table = 'current_events';

    /**
     * Fillable fields.
     *
     * @param array
     */
    protected $fillable = [
        'event_datetime',
        'help_datetime',
        'arrival_datetime',
        'transportation',
        'note',
        'immediate_origin',
    ];

    /**
     * castable fields.
     *
     * @param array
     */
    protected $casts = [];

    /**
     * Fields which are of date type.
     *
     * @param array
     */
    protected $dates = [
        'event_datetime',
        'help_datetime',
        'arrival_datetime',
        'deleted_at'
    ];

    /**
     * @return BelongsTo
     */
    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }

    public function setEventDatetimeAttribute($value)
    {
        $this->attributes['event_datetime'] = to_date($value, 'd/m/Y - H:i');
    }

    public function setHelpDatetimeAttribute($value)
    {
        $this->attributes['help_datetime'] = to_date($value, 'd/m/Y - H:i');
    }

    public function setArrivalDatetimeAttribute($value)
    {
        $this->attributes['arrival_datetime'] = to_date($value, 'd/m/Y - H:i');
    }
}
