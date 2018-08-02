<?php

namespace App\Transformers;

use App\Death;
use League\Fractal\TransformerAbstract;

class DeathTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Death $death)
    {
      //dd($death);
        return [
            'date'   => format_date($death->date, 'd/m/Y'),
            'place' => $death->place,
            'cause' => $this->VerificaOption($death, $death->cause),
            'other' => $death->other
        ];
    }

    public function VerificaOption(Death $p, $option)
    {
        if (strpos($option, 'death-cause-') !== false || is_null($option)) {
            return $p->cause;
        } else {
            $c = \App\Option::where([
                ['value', 'like', '%death-cause%'],
                ['label', '=', $option]
            ])->get();
            $p->cause = $c[0]->value;
            $p->save();
            return $p->cause;
        }
    }
}
