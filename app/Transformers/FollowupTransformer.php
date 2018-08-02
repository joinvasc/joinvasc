<?php

namespace App\Transformers;

use App\AmbulatoryCare;
use App\BaseObject;
use App\Ccs;
use App\CurrentEvent;
use App\Death;
use App\Demographic;
use App\Discharge;
use App\Biobase;
use App\Epivasc;
use App\Exams;
use App\FirstEvent;
use App\Followup;
use App\ImageEvaluations;
use App\Indicators;
use App\Patient;
use App\PatientOrigin;
use App\RiskFactors;
use App\SocioeconomicCondition;
use App\FormAlta;
use App\ImageForm;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;


class FollowupTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'patient',
        'first_event',
        'current_event',
        'exams',
        'demographic',
        'patient_origin',
        'socioeconomic_conditions',
        'risk_factors',
        'discharge',
        'biobase',
        'ccs',
        'death',
        'ambulatory_care', // nao mexer
        'imageform',
        'epivasc',
        'indicators',
        'formalta'
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Followup $followup)
    {
        $now = Carbon::now();
        $agora = Carbon::now()/*->format('d/m/Y')*/;

        $interview_date = $followup->interview_date ?? $agora;
        $admission_date = $followup->admission_date ?? $now;

        return [
            'id'             => $followup->getKey(),
            'interview_date' =>  format_date($interview_date, 'd/m/Y'),//format_date($interview_date),
            'admission_date' =>  format_date($admission_date, 'd/m/Y - H:i'),//format_date($admission_date),
            'treatment_type' => $followup->treatment_type,
            'hospital'       => $followup->hospital,
            'created_at'     => format_date($followup->created_at),
            'updated_at'     => format_date($followup->updated_at),
            'deleted_at'     => format_date($followup->deleted_at),
            'PersonID'       => $followup->PersonID,
            'disabled'       => $followup->disabled,
            'reason'         => $followup->reason,
            'group'          => $followup->group
        ];
    }

    public function includePatient(Followup $followup)
    {
        return $this->item($followup->patient ?? new Patient([]), new PatientTransformer());
    }

    public function includeFirstEvent(Followup $followup)
    {
        return $this->item($followup->firstEvent ?? new FirstEvent([]), new FirstEventTransformer());
    }

    public function includeCurrentEvent(Followup $followup)
    {
        return $this->item($followup->currentEvent ?? new CurrentEvent([]), new CurrentEventTransformer());
    }

    public function includeExams(Followup $followup)
    {
        return $this->item($followup->exams ?? new Exams([]), new ExamsTransformer());
    }

    public function includeDemographic(Followup $followup)
    {
        return $this->item($followup->demographic ?? new Demographic([]), new DemographicTransformer());
    }

    public function includePatientOrigin(Followup $followup)
    {
        return $this->item($followup->patientOrigin ?? new PatientOrigin([]), new PatientOriginTransformer());
    }

    public function includeSocioeconomicConditions(Followup $followup)
    {
        return $this->item($followup->socioeconomicConditions ?? new SocioeconomicCondition([]),
            new SocioeconomicConditionTransformer());
    }

    public function includeRiskFactors(Followup $followup)
    {
        return $this->item($followup->riskFactors ?? new RiskFactors([]), new RiskFactorsTransformer());
    }

    public function includeDischarge(Followup $followup)
    {
        return $this->item($followup->discharge ?? new Discharge([]), new DischargeTransformer());
    }

    public function includeBiobase(Followup $followup)
    {
        return $this->item($followup->biobase ?? new Biobase([]), new BiobaseTransformer());
    }

    public function includeCcs(Followup $followup)
    {
        return $this->item($followup->ccs ?? new Ccs([]), new CcsTransformer());
    }

    public function includeDeath(Followup $followup)
    {
        return $this->item($followup->death ?? new Death([]), new DeathTransformer());
    }

    public function includeAmbulatoryCare(Followup $followup)
    {
        return $this->item($followup->ambulatoryCares ?? new AmbulatoryCare([]), new AmbulatoryCareTransformer());
    }

    public function includeImageForm(Followup $followup)
    {
        return $this->item($followup->imageform ?? new ImageForm([]), new ImageFormTransformer());
    }

    public function includeFormAlta(Followup $followup)
    {
        return $this->item($followup->formalta ?? new FormAlta([]), new FormAltaTransformer());
    }

    public function includeEpivasc(Followup $followup)
    {
        return $this->item($followup->epivasc ?? new Epivasc([]), new EpivascTransformer());
    }

    public function includeIndicators(Followup $followup)
    {
        return $this->item($followup->indicators ?? new Indicators([]), new IndicatorsTransformer());
    }
}
