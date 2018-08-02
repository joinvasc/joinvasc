<?php
/**
 *
 * User: Harry
 * Date: 28/01/2017
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Demographic extends BaseModel
{
    use SoftDeletes;

    protected $table = 'demographics';

    /**
     * Fillable fields.
     *
     * @param array
     */
    protected $fillable = [
        'schooling',
        'profession',
        'health',
        'city',
        'contact',
        'address',
        'note',
        'race',
        'weight',
        'height',
        'imc',
        'age',
    ];

    /**
     * castable fields.
     *
     * @param array
     */
    protected $casts = [
        'schooling' => 'object',
        'profession' => 'object',
        'city'      => 'object',
        'contact'   => 'object',
        'address'   => 'object',
        'health'   => 'object',
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
