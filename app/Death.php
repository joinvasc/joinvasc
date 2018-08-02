<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Death extends Model
{
    use SoftDeletes;
    protected $table = 'deaths';

    protected $fillable = [
        'date',
        'place',
        'cause',
        'other',
    ];

    protected $dates = ['date', 'deleted_at'];

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
