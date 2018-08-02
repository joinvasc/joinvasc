<?php

namespace App\Transformers;

use App\Indicators;
use League\Fractal\TransformerAbstract;

class IndicatorsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Indicators $ind)
    {
        return [
            //
        ];
    }
}
