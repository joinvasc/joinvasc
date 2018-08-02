<?php

namespace App\Transformers;

use App\Option;
use League\Fractal\TransformerAbstract;

class OptionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Option $opt)
    {
        return [
            'id'    => $opt->getKey(),
            'group' => $opt->group,
            'value' => $opt->value,
            'label' => $opt->label,
        ];
    }
}
