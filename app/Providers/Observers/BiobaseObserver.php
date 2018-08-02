<?php

namespace App\Observers;

use App\Biobase;

/**
 *
 * User: vanderlei
 * Date: 01/03/17
 */
class BiobaseObserver
{
    public function created(Biobase $biobase)
    {
/*        $now = $biobase->date->format('Ymd') ? Carbon::now()->format('Ymd') : null;
        $biobase->code = $now . sprintf('%02d', $biobase->getKey());
        $biobase->save();*/
    }
}