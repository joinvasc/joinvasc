<?php

namespace App\Transformers;

use App\Biobase;
use App\Followup;
use App\Discharge;
use League\Fractal\TransformerAbstract;
use Carbon\Carbon;

class DischargeTransformer extends TransformerAbstract
{

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Discharge $d)
    {
        $avc_ait = $d->avc_ait ?? ['value' => null];
        $avc_itoast = $d->avc_itoast ?? ['type' => null, 'surgery' => null];
        $avc_h = $d->avc_h ?? ['type' => null, 'surgery' => null];
        $avc_hsa = $d->avc_hsa ?? ['surgery' => null];

        return [
            'date'           => format_date($d->date),
            'avc_type'       => $d->avc_type,
            'avc_ait'        => $avc_ait,
            'avc_itoast'     => $this->getAvcItoast($d),
            'avc_h'          => $avc_h,
            'image_capture'  => $d->image_capture,
            'avc_hsa'        => $avc_hsa,
            'rankin'         => $d->rankin,
            'barthel'        => $d->barthel,
            'hmsj_uavc'      => $this->getHmsjUavc($d),
            'biobase_status' => !is_null($d->biobase),
            'date_now'      => $this->getNow($d),
            'other'        => $d->other,
            'id'           => $d->followup_id
        ];
    }
    public function getNow(Discharge $rf)
    {
        $fo = new Followup;
      if ($rf->followup_id != 0) {
        $my = $fo->where('id', $rf->followup_id)->get();
        $mytime = $my[0]->admission_date;
      } else {
        $mytime = Carbon::now();
      }
        return collect([
          'descriptions'  =>  $mytime->format('Ydm'),
        ])->merge($rf->date_now)->toArray();
    }

    public function getSeq(Biobase $b, $value)
    {
        $seq = 1 + $b->whereRaw("code LIKE '$value%'")->count();
        return $value.$seq;
    }

    public function getAvcItoast(Discharge $rf)
    {
        $values=  collect([
            'surgery'  => null,
            'type' => [],
        ])->merge($rf->avc_itoast)->toArray();
        
        if(isset($values['type'])){
            for($x=0; $x < count($values['type']); $x++){            
                $values['type'][$x] = $this->VerificaOptionAvcItoast($values['type'][$x]);
            }
        }
        return $values;
    }

    public function VerificaOptionAvcItoast($option)
    {
        if (strpos($option, 'discharge-avc-itoast-') !== false || is_null($option)) {
            return $option;
        } else {
            $c = \App\Option::where([
                ['value', 'like', '%discharge-avc-itoast%'],
                ['label', '=', $option]
            ])->get();
            return $c[0]->value;
        }
    }

    public function getHmsjUavc(Discharge $rf)
    {
        return collect([
            'description'  =>  null,
        ])->merge($rf->hmsj_uavc)->toArray();
    }

}
