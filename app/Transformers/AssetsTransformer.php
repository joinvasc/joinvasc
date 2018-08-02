<?php

namespace App\Transformers;

use App\Assets;
use League\Fractal\TransformerAbstract;

class AssetsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param $assets
     * @return array
     */
    public function transform(Assets $assets)
    {
        return [
            'bathrooms'         => $assets->bathrooms,
            'domestic_servants' => $assets->domestic_servants,
            'automobiles'       => $assets->automobiles,
            'motorcycles'       => $assets->motorcycles,
            'computers'         => $assets->computers,
            'dishwashers'       => $assets->dishwashers,
            'fridges'           => $assets->fridges,
            'freezers'          => $assets->freezers,
            'washing_machines'  => $assets->washing_machines,
            'dvds'              => $assets->dvds,
            'microwaves'        => $assets->microwaves,
            'clothes_dryers'    => $assets->clothes_dryers,
        ];
    }
}
