<?php

namespace App\Transformers;

use App\Follow30;
use League\Fractal\TransformerAbstract;

class Follow30Transformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Follow30 $e)
    {
        return [
            "avc_monitoring"  => $e->avc_monitoring,
            "health_center"  => $e->health_center,
            "frequency_health_center"  =>  $e->frequency_health_center,
            "blood_pressure"  =>  $e->blood_pressure,
            "hba1c_value"   => $e->hba1c_value,
            "hba1c_answer"  =>  $e->hba1c_answer,
            "ldl_value"   => $e->ldl_value,
            "ldl_answer"  =>  $e->ldl_answer,
            "smoking"  =>  $e->smoking,
            "follow_rankin30"  =>  $e->follow_rankin30,
            "capilar_value"  =>  $e->capilar_value,
            "capillar_answer"  =>  $e->capillar_answer,
            "note" => $e->note,
            "postname" => $e->note,
            "especialities" => $e->especialities,    
            "fuespecialitites" => $e->fuespecialities,
        ];
    }
}
