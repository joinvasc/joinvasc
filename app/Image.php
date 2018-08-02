<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    //
    
    protected $table = 'image';

    protected $fillable = [
        'cranial_tomography',
        'magnetic_resonance',
        'hemorrhagic_stroke',
        'intraparenchymal',
        'lobar_topography',
        'deep_topography',
        'subarachnoid_hemorrhage',
        'hemorrhage_side',
        'fisher',
        'hydrocephalus',
        'angiography',
        'angio_resonance',
        'DSA',
        'radiation_control',
        'tomography_aspects',
        'tomography_side',
        'tomography_topography',
        'tomography_cerebellum',
        'tomography_vascular_territory',
        'tomography_swelling',
        'mr_AVC_ischemic_detected',
        'mr_dwi_restriction',
        'mr_side',
        'mr_topography',
        'mr_cerebellum',
        'mr_vascular_territory',
        'mr_swelling',
        'radiation_research',
        'swelling',
        'AVC_ischemic',
        'hemorrhage_transform'
    ];
}
