<?php

namespace App\Transformers;

use App\Biobase;
use League\Fractal\TransformerAbstract;


class BiobaseTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Biobase $b)
    {
        return [
            'receipt_date'  => $b->receipt_date ? format_date($b->receipt_date, 'd/m/Y') : null,
            'extraction_date'  => $b->extraction_date ? format_date($b->extraction_date, 'd/m/Y') : null,
            'dna_quantification'  => $b->dna_quantification,
            'storage_date'  => $b->storage_date ? format_date($b->storage_date, 'd/m/Y') : null,
            'freezer_location'  => $b->freezer_location,
            'note'  => $b->note,
            'control_1'  => $this->getControl($b->control_1),
            'control_2'  => $this->getControl($b->control_2),
            'control_3'  => $this->getControl($b->control_3),
            'control_4'  => $this->getControl($b->control_4),
            'control_5'  => $this->getControl($b->control_5),
        ];
    }

    public function getControl($control)
    {
        return $control ?? [
            'code' => null,
            'name' => null, 
            'born_date' => null, 
            'interview_date' => null, 
            'gender' => null, 
            'kinship' => null, 
            'race' => null, 
            'cep' => null, 
            'address' => null, 
            'number' => null, 
            'neighborhood' => null, 
            'reference' => null, 
            'avc' => null, 
            'kindred_avc' => null, 
            'another_kinship' => null, 
            'hypertension' => null, 
            'diabetes' => null, 
            'dyslipidemia' => null, 
            'smoking' => null, 
            'cardiopathy' => null,        
            'cardiopathy_description' => null,        
        ];
    }
}
