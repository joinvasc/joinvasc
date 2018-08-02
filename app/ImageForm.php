<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ImageForm extends Model
{
	use SoftDeletes;
	
    protected $table = 'imageform';

	protected $fillable = [
			'avc_h',
			'avc_intra',
			'hs',
			'topolobar',
			'topoprofunda',
			'volhematoma',
			'iv',
			'fisher',
			'hidrocefalia',
			'angiotomografia',
			'aneurisma',
			'angiornm',
			'aneurismarnm',
			'dsa',
			'aneurismadsa',
			'ic',
			'avc_i',
			'avc_tc',
			'avc_rnm',
			'dal',
			'rnm_cd',
			'efeitotumofativo',
			'avc_th',
			'thop',
			'fa_aspects',
			'fa_lado',
			'fa_topografia',
			'tvc_op',
			'fa_tumefativo',
			'fa_detec',
			'fa_dwi',
			'rnm_topografia',
			'rnm_lado',
			'fa_lado_rnm',
			'fa_topornm',
			'fa_tvcrnm',
			'fa_atc',
			'rnm_tvc',
			'rnm_tvc_op',
			'rnm_tumefativo',
			'rnm_selec',
			'tvc_oprnm',
			'et_rnm',
			'atc_opga',
			'arnm_opga',
			'avc_rnm_th',
			'rnm_opga',
			'atc_entrenose',
			'fa_atcextra',
			'rnm_avcidetec',
			'rnm_rdwi',
			'rnm_thop',
			'rnm_dal',
			'rnm_et',
			'fa_tvc',
			'dsanew', //Campo novo OK
			'dsanote', //Campo novo OK
			'rnm_normal', //Campo novo OK
			'rnm_acd', //Campo novo OK
			'rnm_ace', //Campo novo OK
			'rnm_avd', //Campo novo OK
			'rnm_ave', //Campo novo OK
			'rnm_acdlado', //Campo novo OK
			'rnm_acdloc', //Campo novo OK
			'rnm_acdestlado', //Campo novo OK
			'rnm_acdestloc', //Campo novo OK
			'rnm_acelado', //Campo novo OK
			'rnm_aceloc', //Campo novo OK
			'rnm_aceestlado', //Campo novo OK
			'rnm_aceestloc', //Campo novo OK
			'rnm_avdlado', //Campo novo OK
			'rnm_avdloc', //Campo novo OK 
			'rnm_avdestlado', //Campo novo OK
			'rnm_avdestloc', //Campo novo OK
			'rnm_avelado', //Campo novo OK
			'rnm_aveloc', //Campo novo OK
			'rnm_aveestlado', //Campo novo OK
			'rnm_aveestloc', //Campo novo OK
			'rnm_acdestgrau', //Campo novo OK
			'rnm_aceestgrau', //Campo novo OK
			'rnm_avdestgrau', //Campo novo OK
			'rnm_aveestgrau', //Campo novo OK
			'arnm_estopga', //Campo novo OK
			'fa_rnmextra', //Campo novo OK
			'arnm_normal', //Campo novo OK
			'arnm_acd', //Campo novo OK
			'arnm_acdlado', //Campo novo OK
			'arnm_acdloc', //Campo novo OK
			'arnm_acdestlado', //Campo novo OK
			'arnm_acdestloc', //Campo novo OK
			'arnm_acdestgrau', //Campo novo OK
			'arnm_ace', //Campo novo OK
			'arnm_acelado', //Campo novo OK
			'arnm_aceloc', //Campo novo OK
			'arnm_aceestlado', //Campo novo OK
			'arnm_aceestloc', //Campo novo OK
			'arnm_aceestgrau', //Campo novo OK
			'arnm_avd', //Campo novo OK
			'arnm_avdlado', //Campo novo OK
			'arnm_avdloc', //Campo novo OK
			'arnm_avdestlado', //Campo novo OK
			'arnm_avdestloc', //Campo novo OK
			'arnm_avdestgrau', //Campo novo OK
			'arnm_ave', // Campo novo OK
			'arnm_avelado', //Campo novo OK
			'arnm_aveloc', //Campo novo OK
			'arnm_aveestlado', //Campo novo OK
			'arnm_aveestloc', //Campo novo OK
			'arnm_aveestgrau', //Campo novo OK
			'css1',
			'css2',
			'css3',
			'uploadimg',
	];

	/**
     * castable fields.
     *
     * @param array
     */
    protected $casts = [
        'css1'   => 'array',
		'css2' => 'array',
		'css3' => 'array',
	];
	
	protected $dates = ['deleted_at'];
	
	/**
     * @return BelongsTo
     */
    public function followup(): BelongsTo
    {
        return $this->belongsTo(Followup::class);
    }
}
