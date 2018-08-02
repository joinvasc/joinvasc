<?php

namespace App\Transformers;

use App\Patient;
use League\Fractal\TransformerAbstract;

class PatientTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Patient $patient)
    {
        $last_followup = $patient->followups()->orderBy('created_at', 'desc')->first();
        $followup = $patient->followups()->where('PersonID', $patient->id_person)->first();
         if(isset($patient->telefone)){
            $telefone = [];
            for($x=0; $x < count($patient->telefone); $x++){            
               $telefone[$x] = $this->VerificaOption($patient, $patient->telefone[$x]);
            }
        }

        return [
            'id'                 => $patient->id,
            'name'               => $patient->name,
            'cpf'                 => $patient->cpf,
            'records_identifier' => $patient->records_identifier,
            'gender'             => $patient->gender,
            'telefone'           => $telefone ?? [],
            'birth_date'         => format_date($patient->birth_date),
            'updated_at'         => format_date($patient->updated_at),
            'deleted_at'         => format_date($patient->deleted_at),
            'last_followup_id'   => isset($last_followup) ? $last_followup->id : null,
            'id_followup'        => $followup->id ?? null,
            'admission_date'     => isset($followup->admission_date)?format_date($followup->admission_date, 'd/m/Y') : null
        ];
    }

    public function VerificaOption(Patient $p, $option)
    {
        if (strpos($option, 'patient-info-telefone-') !== false || is_null($option)) {
            return $option;
        } else {
            $c = \App\Option::where([
                ['value', 'like', '%patient-info-telefone%'],
                ['label', '=', $option]
            ])->get();
            $p->save();
            return $c[0]->value;
        }
    }
}
