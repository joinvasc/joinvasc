<?php

namespace App;

class Follow1a extends BaseModel{

  protected $table = 'follow1a';

  /**
   * Fillable fields.
   *
   * @param array
   */
  
  protected $fillable = [
      "avc_monitoring",
      "health_center",
      "frequency_health_center",
      "blood_pressure",
      "hba1c_value",
      "hba1c_answer",
      "ldl_value",
      "ldl_answer",
      "smoking",
      "follow_rankin30",
      "capilar_value",
      "capillar_answer",
      "especialities",
      "note",
      "fuespecialities",
      "nbperiods",
      "presencacrises",
      "antiepiletic",
  ];
  
  /**
   * castable fields.
   *
   * @param array
   */


  /**
   * Fields which are of date type.
   *
   * @param array
   */
    protected $casts = [
        'blood_pressure'   => 'array',
        'avc_monitoring' => 'array',
        'especialities' => 'array',
        'fuespecialities' => 'array',
    ];

  /**
   * @return BelongsTo
   */
  public function followup(): BelongsTo
  {
      return $this->belongsTo(Followup::class);
  }

}