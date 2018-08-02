<?php

namespace App\Transformers;

use App\SocioeconomicCondition;
use League\Fractal\TransformerAbstract;
use Route;

class SocioeconomicConditionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    /*public function transform(SocioeconomicCondition $sec)
    {
        $sec = $sec->findOrFail(Route::current()->parameters['followup']->id);
        return [
            'schooling'               => $sec->schooling,
            'child_health'            => $sec->child_health,
            'social_class'            => $sec->social_class,
            'healthcenter_attendance' => $sec->healthcenter_attendance,
            'piped_water'             => $sec->piped_water,
            'paved_street'            => $sec->paved_street,
            'assets'                  => $this->getAssets($sec),
        ];
    }*/

public function transform(SocioeconomicCondition $sec)
{

    //$schooling = $sec->schooling ?? ['value' => 'demographic-schooling-ait'];

    return [
        'schooling'               => $sec->schooling,
        'child_health'            => $sec->child_health,
        'healthcenter_attendance' => $sec->healthcenter_attendance,
        'piped_water'             => $sec->piped_water,
        'paved_street'            => $sec->paved_street,
        'assets'                  => $this->getAssets($sec),
    ];
}

    public function getAssets(SocioeconomicCondition $sec)
    {
        return $sec->assets ?? [
                'bathrooms'         => null,
                'domestic_servants' => null,
                'automobiles'       => null,
                'motorcycles'       => null,
                'computers'         => null,
                'dishwashers'       => null,
                'fridges'           => null,
                'freezers'          => null,
                'washing_machines'  => null,
                'dvds'              => null,
                'microwaves'        => null,
                'clothes_dryers'    => null,
            ];
    }
}
