<?php

namespace App\Transformers;

use App\PatientOrigin;
use League\Fractal\TransformerAbstract;

class PatientOriginTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(PatientOrigin $po)
    {
        return [
            'ecocarotidas_doctor' => $po->ecocarotidas_doctor,
            'ecocarotidas_date'   => format_date($po->ecocarotidas_date),
            'immediate_origin'    => $this->VerificaOption($po, $po->immediate_origin),
        ];
    }

    public function VerificaOption(PatientOrigin $p, $option)
    {
        if (strpos($option, 'patient-origin-immediate-origin-') !== false || is_null($option)) {
            return $p->immediate_origin;
        } else {
            $c = \App\Option::where([
                ['value', 'like', '%patient-origin-immediate-origin%'],
                ['label', '=', $option]
            ])->get();
            $p->immediate_origin = $c[0]->value;
            $p->save();
            return $p->immediate_origin;
        }
    }
}
