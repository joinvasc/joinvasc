<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Biobase extends Model
{
     use SoftDeletes;

    protected $table = 'biobases';

    protected $fillable = [
        'id', 
        'receipt_date',
        'extraction_date',
        'dna_quantification',
        'storage_date',
        'freezer_location',
        'note',
        'control_1',
        'control_2',
        'control_3',
        'control_4',
        'control_5',
    ];

    protected $casts = [
        'control_1' => 'array',
        'control_2' => 'array',
        'control_3' => 'array',
        'control_4' => 'array',
        'control_5' => 'array',
    ];

    protected $dates = [
        'receipt_date',
        'extraction_date',
        'storage_date',
        'deleted_at',
    ];

    /**
     * @return BelongsTo
     */
    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }

    public function setReceiptDateAttribute ($value) {
      $this->attributes['receipt_date'] = to_date($value, 'd/m/Y');
    }   

    public function setExtractionDateAttribute ($value) {
      $this->attributes['extraction_date'] = to_date($value, 'd/m/Y');
    }  

    public function setStorageDateAttribute ($value) {
      $this->attributes['storage_date'] = to_date($value, 'd/m/Y');
    }   
}
