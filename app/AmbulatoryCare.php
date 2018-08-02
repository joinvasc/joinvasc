<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class AmbulatoryCare extends Model
{
  use SoftDeletes;
  protected $table = 'ambulatory_care';

  /**
   * Fillable fields.
   *
   * @param array
   */

  protected $fillable = [
    'time',
    'follow30',
    'follow3m',
    'follow1a',
    'follow2a',
    'follow3a',
    'follow4a',
    'follow5a',
    'dead_in',

  ];
    
    protected $casts = [
      'follow30' =>  'object',
      'follow3m' =>  'object',
      'follow1a' =>  'object',
      'follow2a' =>  'object',
      'follow3a' =>  'object',
      'follow4a' =>  'object',
      'follow5a' =>  'object',

    ];

    protected $dates = ['deleted_at'];
  /**
   * @return BelongsTo
   */
  public function followup(): BelongsTo
  {
      return $this->belongsTo(Followup::class);
  }

  public function setFollow30($value) {
    dd($value);
  }
}
