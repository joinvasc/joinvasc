<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Patient;

class Followup extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'interview_date',
        'admission_date',
        'treatment_type',
        'hospital',
        'PersonID',
        'disabled',
        'reason',
        'group'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'interview_date',
        'admission_date'
    ];

    /**
     * @return BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class,'PersonID', 'id_person');
    }

    public function firstEvent(): HasOne
    {
        return $this->hasOne(FirstEvent::class);
    }

    public function currentEvent(): HasOne
    {
        return $this->hasOne(CurrentEvent::class);
    }

    public function exams(): HasOne
    {
        return $this->hasOne(Exams::class);
    }

    public function demographic(): HasOne
    {
        return $this->hasOne(Demographic::class);
    }

    public function patientOrigin(): HasOne
    {
        return $this->hasOne(PatientOrigin::class);
    }

    public function socioeconomicConditions(): HasOne
    {
        return $this->hasOne(SocioeconomicCondition::class);
    }

    public function riskFactors(): HasOne
    {
        return $this->hasOne(RiskFactors::class);
    }

    public function discharge(): HasOne
    {
        return $this->hasOne(Discharge::class);
    }

    public function biobase(): HasOne
    {
        return $this->hasOne(Biobase::class);
    }

    public function ccs(): HasOne
    {
        return $this->hasOne(Ccs::class);
    }

    public function death(): HasOne
    {
        //dd(Death::class);
        return $this->hasOne(Death::class);
    }

    public function ambulatoryCare(): HasOne // hasmany?
    {
        return $this->hasOne(AmbulatoryCare::class);
    }
    public function ambulatoryCares(): HasOne // hasmany?
    {
        return $this->hasOne(AmbulatoryCare::class);
    }

    public function imageForm(): HasOne
    {
        return $this->hasOne(ImageForm::class);
    }

    public function formAlta(): HasOne 
    {
        return $this->hasOne(FormAlta::class);
    }

    public function epivasc(): HasOne
    {
        return $this->hasOne(Epivasc::class);
    }

    public function indicators(): HasOne
    {
        return $this->hasOne(Indicators::class);
    }
    
    public function follow30(): HasOne
    {
        return $this->hasOne(follow30::class);
    }

    public function follow3m(): HasOne
    {
        return $this->hasOne(follow3m::class);
    }

    public function follow1a(): HasOne
    {
        return $this->hasOne(follow1a::class);
    }

    public function follow2a(): HasOne
    {
        return $this->hasOne(follow1a::class);
    }

    public function follow3a(): HasOne
    {
        return $this->hasOne(follow1a::class);
    }

    public function follow4a(): HasOne
    {
        return $this->hasOne(follow4a::class);
    }

    public function follow5a(): HasOne
    {
        return $this->hasOne(follow5a::class);
    }

    public function setInterviewDateAttribute($value)
    {
        //$this->attributes['interview_date'] = to_date($value, 'd/m/Y - H:i');
          $this->attributes['interview_date'] = to_date($value);
    }

    public function setAdmissionDateAttribute($value)
    {
      //  $this->attributes['admission_date'] = to_date($value);
        $this->attributes['admission_date'] = to_date($value, 'd/m/Y - H:i');
    }
}
