<?php

namespace App\Transformers;

use App\Ccs;
use League\Fractal\TransformerAbstract;

class CcsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Ccs $ccs)
    {
        return [
            'laa'              => $ccs->laa,
            'cae'              => $ccs->cae,
            'sao'              => $ccs->sao,
            'other_causes'     => $ccs->other_causes,
            'undefined_causes' => $ccs->undefined_causes,
        ];
    }
}
