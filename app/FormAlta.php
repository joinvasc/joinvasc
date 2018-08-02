<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormAlta extends Model
{
	use SoftDeletes;
    protected $table = 'formalta';

	protected $fillable = [
			'medhas',
			'meddm',
			'meddis',
			'medanti',
			'medantico',
			'enca',
			'encseg',
			'medepilepsia',
	];

	 /**
     * castable fields.
     *
     * @param array
     */
    protected $casts = [
       		'medhas' => 'array',
			'meddm' => 'array',
			'meddis' => 'array',
			'medanti' => 'array',
			'medantico' => 'array',
			'enca' => 'array',
			'encseg' => 'array',
			'medepilepsia' => 'array', 
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
