<?php

namespace App\Transformers;

use App\Epivasc;
use League\Fractal\TransformerAbstract;

class EpivascTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Epivasc $e)
    {
        return [
            //
            'clinical_history' => $e->clinical_history ?? [],
            'seizures' => $e->seizures ?? []
        ];
    }
}
