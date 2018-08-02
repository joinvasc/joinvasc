<?php

namespace App\Transformers;

use App\RiskFactors;
use League\Fractal\TransformerAbstract;

class RiskFactorsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(RiskFactors $rf)
    {
        return [
            'avc'           => $this->getAvc($rf),
            'hypertension'  => $this->getHypertension($rf),
            'diabetes'      => $this->getDiabetes($rf),
            'alcohol'       => $this->getAlcohol($rf),
            'dyslipidemia'  => $this->getDyslipidemia($rf),
            'cardiopathy'   => $this->getCardiopathy($rf),
            'antitrombotic' => $this->getAntitrombotic($rf),
            'drugs'         => $this->getDrugs($rf),
            'smoking'       => $this->getSmoking($rf),
            'sedentary'     => $this->getSedentary($rf),
            'other'         => $rf->other,
        ];
    }

    public function getAvc(RiskFactors $rf)
    {

        return collect([
            'family'  => null,
            'parents' => null,
        ])->merge($rf->avc)->toArray();
    }

    public function getHypertension(RiskFactors $rf)
    {
        return collect([
            'status'          => false,
            'months'          => null,
            'years'          => null,
            'medicines'       => null,
            'medicines_items' => null,
            'group_visit'     => null,
            'pa'              => null,
            'pa_answer'       => null,
            'conclusion'      => null,
        ])->merge($rf->hypertension)->toArray();
    }

    public function getDiabetes(RiskFactors $rf)
    {

        return collect([
            'status'                  => null,
            'group_visit'             => null,
            'months'                  => null,
            'medicines'               => null,
            'medicines_items'         => null,
            'hemoglobin_level'        => null,
            'hemoglobin_hba1c_status' => null,
            'hemoglobin_hba1c_level'  => null,
        ])->merge($rf->diabetes)->toArray();
    }

    public function getAlcohol(RiskFactors $rf)
    {
        return collect([
            'status' => null,
            'doses'  => null,
            'rating' => null,
        ])->merge($rf->alcohol)->toArray();
    }

    public function getDyslipidemia(RiskFactors $rf)
    {
        $values =  collect([
            'status'          => null,
            'medicines'       => null,
            'medicines_items' => [],
            'months' => null,
        ])->merge($rf->dyslipidemia)->toArray();

        if(isset($values['medicines_items'])){
            for($x=0; $x < count($values['medicines_items']); $x++){            
                $values['medicines_items'][$x] = $this->VerificaOptionDyslipidemia($values['medicines_items'][$x]);
            }
        }
        return $values;
    }

    public function VerificaOptionDyslipidemia($option)
    {
        if (strpos($option, 'risk-factors-dyslipidemia-medicines-items-') !== false || is_null($option)) {
            return $option;
        } else {
            $c = \App\Option::where([
                ['value', 'like', '%risk-factors-dyslipidemia-medicines-items%'],
                ['label', '=', $option]
            ])->get();
            return $c[0]->value;
        }
    }

    public function getCardiopathy(RiskFactors $rf)
    {
        return collect([
            'status'              => null,
            'patologies'          => null,
            'custom_patology'     => null,
            'anticoagulant_usage' => null,
            'anticoagulant_items' => null,
            'conclusion'          => null,
        ])->merge($rf->cardiopathy)->toArray();
    }

    public function getAntitrombotic(RiskFactors $rf)
    {
        return collect([
            'medicines'         => null,
            'medicines_items'   => [],
            'pvi'               => null,
            'revascularization' => null,
        ])->merge($rf->antitrombotic)->toArray();
    }

    public function getDrugs(RiskFactors $rf)
    {
        return collect([
            'usage'          => null,
            'usage_months'   => null,
            'stopped_months' => null,
            'description'    => null,
            'sedentary'      => [
                'status' => null
            ],
        ])->merge($rf->drugs)->toArray();
    }

    public function getSmoking(RiskFactors $rf)
    {
      return collect([
          'status'          => null,
          'livedwith'   => null,
      ])->merge($rf->smoking)->toArray();

    }

    public function getSedentary(RiskFactors $rf)
    {
        return collect([
            'status' => null,
        ])->merge($rf->sedentary)->toArray();
    }
}
