<?php
/**
 *
 * User: Harry
 * Date: 20/01/2017
 */
namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Exams extends BaseModel
{
    use SoftDeletes;
    protected $table = 'exams';

    /**
     * Fillable fields.
     *
     * @param array
     */
    protected $fillable = [
        'nih',
        'previous_rankin',
        'admission_rankin',
        'barthel',
        'list',
        'banford',
        'actilyise_date',
        'fasting_blood_glicose',
        'triglycerides',
        'total_cholesterol',
        'hdl',
        'ldl',
        'uric_acid',
        'creatinine',
        'ecg',
        'ecg_description',
        'actilyise',
        'vhs',
        'admission_pa',
        'tomography_datetime',
        'holter24',
        'holter3',
        'holter7',
        'note_telemetry_holter',
        'echocardiogram_transthoracic',
        'echocardiogram_transesophageal',
        'echocardiogram_note', 
        'doppler_data_vertebral',
        'doppler_vertebral_note',
        'doppler_data_transcranial',
        'doppler_transcranial_note',
        'cardiac_area',
    ];

    /**
     * castable fields.
     *
     * @param array
     */
    protected $casts = [
        'list'   => 'array',
        'admission_pa' => 'array',
        'banford' => 'array',
        'aci_right'       => 'number',
    ];

    /**
     * Fields which are of date type.
     *
     * @param array
     */
    protected $dates = [
        'tomography_datetime',
        'actilyise_date',
        'holter24',
        'holter3',
        'holter7',
        'echocardiogram_transthoracic',
        'echocardiogram_transesophageal',
        'doppler_data_vertebral',
        'doppler_data_transcranial',
        'deleted_at'
    ];

    /**
     * @return BelongsTo
     */
    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }

    public function setTomographyDatetimeAttribute ($value) {
      $this->attributes['tomography_datetime'] = to_date($value, 'd/m/Y - H:i');
    }

    public function setActilyiseDateAttribute ($value) {
        $this->attributes['actilyise_date'] = to_date($value, 'd/m/Y - H:i');
    }

    public function setHolter24Attribute ($value) {
        $this->attributes['holter24'] = to_date($value);
    }
    
    public function setHolter3Attribute ($value) {
        $this->attributes['holter3'] = to_date($value);
    }

    public function setHolter7Attribute ($value) {
        $this->attributes['holter7'] = to_date($value);
    }

    public function setEchocardiogramTransthoracicAttribute ($value) {
        $this->attributes['echocardiogram_transthoracic'] = to_date($value);
    }

    public function setEchocardiogramTransesophagealAttribute ($value) {
        $this->attributes['echocardiogram_transesophageal'] = to_date($value);
    }

    public function setDopplerDataVertebralAttribute ($value) {
        $this->attributes['doppler_data_vertebral'] = to_date($value);
    }

    public function setDopplerDataTranscranialAttribute ($value) {
        $this->attributes['doppler_data_transcranial'] = to_date($value);
    }
}

