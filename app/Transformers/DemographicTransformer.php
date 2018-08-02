<?php

namespace App\Transformers;

use App\Demographic;
use League\Fractal\TransformerAbstract;

class DemographicTransformer extends TransformerAbstract
{
    public function transform(Demographic $dem)
    {   
        return [
            'schooling'  => $this->getSchooling($dem),
            'profession' => $this->getProfession($dem),
            'city'       => $this->getCity($dem),
            'contact'    => $this->getContact($dem),
            'address'    => $this->getAddress($dem),
            'health'     => $this->getHealth($dem),
            'note'       => $dem->note,
            'race'       => $dem->race,
            'weight'     => $dem->weight,
            'height'     => $dem->height,
            'imc'        => $dem->imc,
            'age'        => $dem->age,
        ];
    }
   public function getHealth(Demographic $dem)
    {
        if(isset($dem->health)){   
            $option = $this->VerificaOption($dem->health->healthcare_attendance, 'demographic-healthcare-attendance-');
            return [
                'child_health'          => $dem->health->child_health,
                'healthcare_attendance' => $option,
            ];
        }

        return $dem->health ?? [
            'child_health'          => null,
            'healthcare_attendance' => null,
        ];
    }

    public function getSchooling(Demographic $dem)
    {
        return $dem->schooling ?? [
                'father'  => null,
                'mother'  => null,
                'patient' => null,
            ];
    }

    public function getProfession(Demographic $dem)
    {

        if(isset($dem->profession)){   
            $optionCurrent = $this->VerificaOption($dem->profession->current, 'demographic-profession-');
            $optionFather = $this->VerificaOption($dem->profession->father, 'demographic-profession-');
            return [
                'current'   => $optionCurrent,
                'father'    => $optionFather,
            ];
        }

        return $dem->profession ?? [
                'current' => null,
                'father'  => null,
            ];
    }

    public function getAddress(Demographic $dem)
    {
        return $dem->address ?? [
                'cep'          => null,
                'name'         => null,
                'number'       => null,
                'neighborhood' => null,
                'reference'    => null,
            ];
    }

    public function getContact(Demographic $dem)
    {
        return $dem->contact ?? [
                'phone'        => null,
                'mobile'       => null,
                'office_phone' => null,
                'office_name'  => null,
                'note'         => null,
            ];
    }

    public function getCity(Demographic $dem)
    {
        return $dem->city ?? [
                'joinville' => null,
                'time'      => null,
            ];
    }

    public function VerificaOption($option, $prefix)
    {
        if (strpos($option, $prefix) !== false || is_null($option)) {
            return $option ;
        } else {
            $c = \App\Option::where([
                ['value', 'like', '%'.$prefix.'%'],
                ['label', '=', $option]
            ])->get();
            return $c[0]->value;
        }
    }

}
