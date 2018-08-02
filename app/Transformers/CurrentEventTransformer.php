<?php

namespace App\Transformers;

use App\CurrentEvent;
use League\Fractal\TransformerAbstract;

class CurrentEventTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(CurrentEvent $ce)
    {
        return [
            'event_datetime'   => format_date($ce->event_datetime, 'd/m/Y - H:i'),
            'help_datetime'    => format_date($ce->help_datetime, 'd/m/Y - H:i'),
            'arrival_datetime' => format_date($ce->arrival_datetime, 'd/m/Y - H:i'),
            'transportation'   => $ce->transportation,
            'note'             => $ce->note,
            'immediate_origin' => $ce->immediate_origin,
        ];
    }
}
