<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discharge extends Model
{
    use SoftDeletes;
    protected $table = 'discharges';

    protected $fillable = [
        'date',
        'avc_type',
        'date_now',
        'avc_h',
        'avc_itoast',
        'avc_ait',
        'avc_hsa',
        'rankin',
        'barthel',
        'hmsj_uavc',
        'image_capture',
        'other',
    ];

    protected $dates = ['date', 'deleted_at'];

    protected $casts = [
        'avc_h'         => 'object',
        'avc_ait'       => 'object',
        'avc_itoast'    => 'object',
        'avc_hsa'       => 'object',
        'hmsj_uavc'     => 'object',
        'rankin'        => 'number',
        'barthel'       => 'number',
        'image_capture' => 'object',
        'date_now'      =>'object',
    ];

    /**
     * @return BelongsTo
     */
    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }

    public function setDateAttribute ($value) {
      $this->attributes['date'] = to_date($value, 'd/m/Y');
    }
}
