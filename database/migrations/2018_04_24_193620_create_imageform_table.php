<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageformTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imageform', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('avc_h')->nullable();
			$table->string('avc_intra')->nullable();
			$table->string('hs')->nullable();
			$table->string('topolobar')->nullable();
			$table->string('topoprofunda')->nullable();
			$table->string('volhematoma')->nullable();
			$table->string('iv')->nullable();
			$table->string('fisher')->nullable();
			$table->string('hidrocefalia')->nullable();
			$table->string('angiotomografia')->nullable();
			$table->string('aneurisma')->nullable();
			$table->string('angiornm')->nullable();
			$table->string('aneurismarnm')->nullable();
			$table->string('dsa')->nullable();
			$table->string('aneurismadsa')->nullable();
			$table->string('ic')->nullable();
			$table->string('avc_i')->nullable();
			$table->string('avc_tc')->nullable();
			$table->string('avc_rnm')->nullable();
			$table->string('dal')->nullable();
			$table->string('cd')->nullable();
			$table->string('efeitotumofativo')->nullable();
			$table->string('avc_th')->nullable();
			$table->string('thop')->nullable();
			$table->string('fa_aspects')->nullable();
			$table->string('fa_lado')->nullable();
			$table->string('fa_topografia')->nullable();
			$table->string('tvc_op')->nullable();
			$table->string('fa_tumefativo')->nullable();
			$table->string('fa_detec')->nullable();
			$table->string('fa_dwi')->nullable();
			$table->string('fa_lado_rnm')->nullable();
			$table->string('fa_topornm')->nullable();
			$table->string('fa_tvcrnm')->nullable();
			$table->string('fa_atc')->nullable();
			$table->text('fa_tvc', 65535)->nullable();
			$table->string('rnm_tvc')->nullable();
			$table->string('tvc_oprnm')->nullable();
			$table->string('et_rnm')->nullable();
			$table->string('atc_opga')->nullable();
			$table->string('arnm_opga')->nullable();
			$table->string('avc_rnm_th')->nullable();
			$table->string('rnm_opga')->nullable();
			$table->string('rnm_rdwi')->nullable();
			$table->string('rnm_lado')->nullable();
			$table->string('rnm_topografia')->nullable();
			$table->string('rnm_tvc_op')->nullable();
			$table->string('rnm_tumefativo')->nullable();
			$table->string('rnm_selec')->nullable();
			$table->string('rnm_dal')->nullable();
			$table->string('rnm_cd')->nullable();
			$table->string('rnm_et')->nullable();
			$table->string('rnm_thop')->nullable();
			$table->string('atc_entrenose')->nullable();
			$table->string('fa_atcextra')->nullable();
			$table->text('dsanew', 65535)->nullable();
			$table->text('dsanote', 65535)->nullable();
			$table->text('rnm_normal', 65535)->nullable();
			$table->text('rnm_acd', 65535)->nullable();
			$table->text('rnm_ace', 65535)->nullable();
			$table->text('rnm_avd', 65535)->nullable();
			$table->text('rnm_ave', 65535)->nullable();
			$table->text('rnm_acdlado', 65535)->nullable();
			$table->text('rnm_acdloc', 65535)->nullable();
			$table->text('rnm_acdestlado', 65535)->nullable();
			$table->text('rnm_acdestloc', 65535)->nullable();
			$table->text('rnm_acelado', 65535)->nullable();
			$table->text('rnm_aceloc', 65535)->nullable();
			$table->text('rnm_aceestlado', 65535)->nullable();
			$table->text('rnm_aceestloc', 65535)->nullable();
			$table->text('rnm_avdlado', 65535)->nullable();
			$table->text('rnm_avdloc', 65535)->nullable();
			$table->text('rnm_avdestlado', 65535)->nullable();
			$table->text('rnm_avdestloc', 65535)->nullable();
			$table->text('rnm_avelado', 65535)->nullable();
			$table->text('rnm_aveloc', 65535)->nullable();
			$table->text('rnm_aveestlado', 65535)->nullable();
			$table->text('rnm_aveestloc', 65535)->nullable();
			$table->text('rnm_acdestgrau', 65535)->nullable();
			$table->text('rnm_aceestgrau', 65535)->nullable();
			$table->text('rnm_avdestgrau', 65535)->nullable();
			$table->text('rnm_aveestgrau', 65535)->nullable();
			$table->text('rnm_avcidetec', 65535)->nullable();
			$table->text('arnm_estopga', 65535)->nullable();
			$table->text('fa_rnmextra', 65535)->nullable();
			$table->text('arnm_normal', 65535)->nullable();
			$table->text('arnm_acd', 65535)->nullable();
			$table->text('arnm_acdlado', 65535)->nullable();
			$table->text('arnm_acdloc', 65535)->nullable();
			$table->text('arnm_acdestlado', 65535)->nullable();
			$table->text('arnm_acdestloc', 65535)->nullable();
			$table->text('arnm_acdestgrau', 65535)->nullable();
			$table->text('arnm_ace', 65535)->nullable();
			$table->text('arnm_acelado', 65535)->nullable();
			$table->text('arnm_aceloc', 65535)->nullable();
			$table->text('arnm_aceestlado', 65535)->nullable();
			$table->text('arnm_aceestloc', 65535)->nullable();
			$table->text('arnm_aceestgrau', 65535)->nullable();
			$table->text('arnm_avd', 65535)->nullable();
			$table->text('arnm_avdlado', 65535)->nullable();
			$table->text('arnm_avdloc', 65535)->nullable();
			$table->text('arnm_avdestlado', 65535)->nullable();
			$table->text('arnm_avdestloc', 65535)->nullable();
			$table->text('arnm_avdestgrau', 65535)->nullable();
			$table->text('arnm_ave', 65535)->nullable();
			$table->text('arnm_avelado', 65535)->nullable();
			$table->text('arnm_aveloc', 65535)->nullable();
			$table->text('arnm_aveestlado', 65535)->nullable();
			$table->text('arnm_aveestloc', 65535)->nullable();
			$table->text('arnm_aveestgrau', 65535)->nullable();
			$table->string('css1', 1200)->nullable();
			$table->string('css2', 1200)->nullable();
			$table->string('css3', 1200)->nullable();
			$table->text('uploadimg', 65535)->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->bigInteger('followup_id')->unsigned()->index('imageform_followup_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('imageform');
	}

}
