<?php

namespace App\Transformers;

use App\FirstEvent;
use League\Fractal\TransformerAbstract;

class FirstEventTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(FirstEvent $fe)
    {
        return [
            'previous'         => $fe->previous,
            'number_of_events' => $fe->number_of_events,
            'rehab'            => $fe->rehab,
            'rehab_details'    => $fe->rehab_details ?? [],
            'last_event_date'  => format_date($fe->last_event_date, 'd/m/Y'),
            'hospital'         => $this->VerificaOption($fe, $fe->hospital),
            'hospital_especialities' => $this->VerificaOptionEspecialities($fe, $fe->hospital_especialities),
            'hmsj_uavc'        => $fe->hmsj_uavc,
        ];
    }

    public function VerificaOption(FirstEvent $f, $option)
    {
        if (strpos($option, 'hospitals-') !== false || is_null($option)) {
            return $f->hospital;
        } else {
            $c = \App\Option::where([
                ['value', 'like', '%hospitals-%'],
                ['label', '=', $option]
            ])->get();
            $f->hospital = $c[0]->value;
            $f->save();
            return $f->hospital;
        }
    }
    
    public function VerificaOptionEspecialities(FirstEvent $f, $option)
    {
        if (strpos($option, 'first-event-hospital-especialities-') !== false || is_null($option)) {
            return $f->hospital_especialities;
        } else {
            $c = \App\Option::where([
                ['value', 'like', '%first-event-hospital-especialities-%'],
                ['label', '=', $option]
            ])->get();
            $f->hospital_especialities = $c[0]->value;
            $f->save();
            return $f->hospital_especialities;
        }
    }
}
