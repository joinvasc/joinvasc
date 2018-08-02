<template>
    <div class="panel panel-default">
        <div class="panel-heading">Formulário de imagens</div>
          <div class="panel-body">
            
            <div class="col-xs-6 col-sm-4">
                <label>AVC-H</label>
                    <jv-yesno uid="avc_h" :value="imageform.avc_h"
                        @select="imageform.avc_h = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
            </div>

            <template v-if="imageform.avc_h">
                <div class="row">
                    <div class="col-xs-12">
                        <legend></legend>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 col-sm-6">
                        <label>AVC Intraparenquimatoso</label>
                            <jv-yesno uid="avc_intra" :value="imageform.avc_intra"
                            @select="imageform.avc_intra = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-12 col-sm-6">
                        <label>Hemorragia Subaracnóide</label>
                            <jv-yesno uid="imageform.hs" :value="imageform.hs"
                            @select="imageform.hs = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                    </div>
                </div>

                <template v-if="imageform.avc_intra">
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-8">
                        Topografia Lobar:
                        </label>
                        <jv-select class="col-xs-12 col-sm-4" :value="imageform.topolobar" :options="options['imageform.topolobar']"
                           @select="imageform.topolobar = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-8">
                        Topografia Profunda:
                        </label>
                        <jv-select class="col-xs-12 col-sm-4" :value="imageform.topoprofunda" :options="options['imageform.topoprofunda']"
                           @select="imageform.topoprofunda = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-8">
                        Volume Hematoma
                        </label>
                        <jv-select class="col-xs-12 col-sm-4" :value="imageform.volhematoma" :options="options['imageform.volhematoma']"
                           @select="imageform.volhematoma = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <label>Inundação Ventricular</label>
                            <jv-yesno uid="imageform.iv" :value="imageform.iv"
                            @select="imageform.iv = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                    </div>              
                </template>

                <template v-if="imageform.hs">
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-8">
                        Fisher:
                        </label>
                        <jv-select class="col-xs-12 col-sm-4" :value="imageform.fisher" :options="options['imageform.fisher']"
                           @select="imageform.fisher= arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>Hidrocefalia</label>
                            <jv-yesno uid="imageform.hidrocefalia" :value="imageform.hidrocefalia"
                            @select="imageform.hidrocefalia = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                    </div>
                </template>

                <div class="row">
                    <div class="col-xs-12">
                        <legend>Investigação Completementar</legend>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">
                        Angio Tomografia:
                    </label>
                    <jv-select class="col-xs-12 col-sm-4" :value="imageform.angiotomografia" :options="options['imageform.angiotomografia']"
                           @select="imageform.angiotomografia = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">
                        Aneurisma:
                    </label>
                    <jv-select class="col-xs-12 col-sm-4" :value="imageform.aneurisma" :options="options['imageform.aneurisma']" @select="imageform.aneurisma = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">
                        Angio RNM:
                    </label>
                    <jv-select class="col-xs-12 col-sm-4" :value="imageform.angiornm" :options="options['imageform.angiotomografia']"
                           @select="imageform.angiornm = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">
                        Aneurisma:
                    </label>
                    <jv-select class="col-xs-12 col-sm-4" :value="imageform.aneurismarnm" :options="options['imageform.aneurisma']" @select="imageform.aneurismarnm = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">
                        DSA:
                    </label>
                    <jv-select class="col-xs-12 col-sm-4" :value="imageform.dsa" :options="options['imageform.angiotomografia']"
                           @select="imageform.dsa = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">
                        Aneurisma:
                    </label>
                    <jv-select class="col-xs-12 col-sm-4" :value="imageform.aneurismadsa" :options="options['imageform.aneurisma']" @select="imageform.aneurismadsa = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>
            </template>

                <template v-if="!imageform.avc_h">
                    <div class="col-xs-6 col-sm-4">
                        <label>AVC-I</label>
                            <jv-yesno uid="avc_i" :value="imageform.avc_i"
                            @select="imageform.avc_i = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                    </div>
                    <template v-if="imageform.avc_i">
                        <div class="row">
                            <div class="col-xs-12">
                                <legend></legend>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-6">
                                <label>TC</label>
                                    <jv-yesno uid="avc_tc" :value="imageform.avc_tc"
                                    @select="imageform.avc_tc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12 col-sm-6">
                                <label>RNM</label>
                                    <jv-yesno uid="avc_rnm" :value="imageform.avc_rnm"
                                    @select="imageform.avc_rnm = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                            </div>
                        </div>
                    

                        <template v-if="imageform.avc_tc">
                            <div class="row">
                                <div class="col-xs-12">
                                    <legend>Tomografia</legend>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                ASPECTS
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.fa_aspects" :options="options['imageform.fa_aspects']"
                                    @select="imageform.fa_aspects = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Lado
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.fa_lado" :options="options['imageform.fa_lado']"
                                   @select="imageform.fa_lado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Topografia
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.fa_topografia" :options="options['imageform.fa_topografia']"
                                   @select="imageform.fa_topografia = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Território vascular completo ou >1/3 da ACM:</label>
                                        <jv-yesno uid="fa_tvc" :value="imageform.fa_tvc"
                                        @select="imageform.fa_tvc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>
                            <div v-if="imageform.fa_tvc" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Selecione:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.tvc_op" :options="options['imageform.tvc_op']" @select="imageform.tvc_op = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Efeito tumefativo:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.fa_tumefativo" :options="options['imageform.fa_tumefativo']"
                                   @select="imageform.fa_tumefativo = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Angio TC intracraniana</label>
                                        <jv-yesno uid="fa_atc" :value="imageform.fa_atc"
                                        @select="imageform.fa_atc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>
                            <div v-if="imageform.fa_atc" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Oclusão intracraniana:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.atc_opga" :options="options['imageform.opga']" @select="imageform.atc_opga = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div v-if="imageform.fa_atc" class="row form-group">
                                    <label class="col-xs-12 col-sm-8">
                                    Estenose intracraniana:
                                    </label>
                                    <jv-select class="col-xs-12 col-sm-4" :value="imageform.atc_entrenose" :options="options['imageform.opga']" @select="imageform.atc_entrenose = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                                </div>

                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Angio TC extracraniana</label>
                                        <jv-yesno uid="fa_atcextra" :value="imageform.fa_atcextra"
                                        @select="imageform.fa_atcextra = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="imageform.fa_atcextra" class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Normal</label>
                                        <jv-yesno uid="rnm_normal" :value="imageform.rnm_normal"
                                        @select="imageform.rnm_normal = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="!imageform.rnm_normal && imageform.fa_atcextra" class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>ACD</label>
                                        <jv-yesno uid="rnm_acd" :value="imageform.rnm_acd"
                                        @select="imageform.rnm_acd = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="imageform.rnm_acd && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Oclusão - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_acdlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.rnm_acdlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_acd && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Oclusão - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_acdloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.rnm_acdloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_acd && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Estenose - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_acdestlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.rnm_acdestlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_acd && !imageform.rnm_normal"  class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_acdestloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.rnm_acdestloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_acd && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Grau:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_acdestgrau" :options="options['imageform.rnm_acdgrau']"
                                   @select="imageform.rnm_acdestgrau = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>


                            <div v-if="!imageform.rnm_normal && imageform.fa_atcextra" class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>ACE</label>
                                        <jv-yesno uid="rnm_ace" :value="imageform.rnm_ace"
                                        @select="imageform.rnm_ace = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="imageform.rnm_ace && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Oclusão - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_acelado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.rnm_acelado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_ace && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Oclusão - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_aceloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.rnm_aceloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_ace && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Estenose - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_aceestlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.rnm_aceestlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_ace && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_aceestloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.rnm_aceestloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_ace && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Grau:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_aceestgrau" :options="options['imageform.rnm_acdgrau']"
                                   @select="imageform.rnm_aceestgrau = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="!imageform.rnm_normal && imageform.fa_atcextra" class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>AVD</label>
                                        <jv-yesno uid="rnm_avd" :value="imageform.rnm_avd"
                                        @select="imageform.rnm_avd = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="imageform.rnm_avd && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Oclusão - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_avdlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.rnm_avdlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_avd && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Oclusão - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_avdloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.rnm_avdloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_avd && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Estenose - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_avdestlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.rnm_avdestlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_avd && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_avdestloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.rnm_avdestloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_avd && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Grau:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_avdestgrau" :options="options['imageform.rnm_acdgrau']"
                                   @select="imageform.rnm_avdestgrau = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="!imageform.rnm_normal && imageform.fa_atcextra" class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>AVE</label>
                                        <jv-yesno uid="rnm_ave" :value="imageform.rnm_ave"
                                        @select="imageform.rnm_ave = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="imageform.rnm_ave && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Oclusão - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_avelado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.rnm_avelado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_ave && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Oclusão - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_aveloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.rnm_aveloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_ave && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Estenose - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_aveestlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.rnm_aveestlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_ave && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_aveestloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.rnm_aveestloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.rnm_ave && !imageform.rnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Grau:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_aveestgrau" :options="options['imageform.rnm_acdgrau']"
                                   @select="imageform.rnm_aveestgrau = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                        </template>

                        <template v-if="imageform.avc_rnm">
                            <div class="row">
                                <div class="col-xs-12">
                                    <legend></legend>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>AVC I Detectável</label>
                                        <jv-yesno uid="rnm_avcidetec" :value="imageform.rnm_avcidetec"
                                        @select="imageform.rnm_avcidetec = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Restrição a DWI</label>
                                        <jv-yesno uid="rnm_rdwi" :value="imageform.rnm_rdwi"
                                        @select="imageform.rnm_rdwi = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Lado
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_lado" :options="options['imageform.fa_lado']"
                                   @select="imageform.rnm_lado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Topografia
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_topografia" :options="options['imageform.fa_topografia']"
                                   @select="imageform.rnm_topografia = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Território vascular completo ou >1/3 da ACM:</label>
                                        <jv-yesno uid="rnm_tvc" :value="imageform.rnm_tvc"
                                        @select="imageform.rnm_tvc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>
                            <div v-if="imageform.rnm_tvc" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Selecione:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_tvc_op" :options="options['imageform.tvc_op']" @select="imageform.rnm_tvc_op = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Efeito tumefativo:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_tumefativo" :options="options['imageform.fa_tumefativo']"
                                   @select="imageform.rnm_tumefativo = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Angio RNM intracraniana</label>
                                        <jv-yesno uid="rnm_atc" :value="imageform.angiornm"
                                        @select="imageform.angiornm = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>
                            <div v-if="imageform.angiornm" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Oclusão intracraniana
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_opga" :options="options['imageform.opga']" @select="imageform.arnm_opga = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.angiornm" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Estenose intracraniana
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_estopga" :options="options['imageform.opga']" @select="imageform.arnm_estopga = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Angio RNM extracraniana</label>
                                        <jv-yesno uid="fa_rnmextra" :value="imageform.fa_rnmextra"
                                        @select="imageform.fa_rnmextra = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="imageform.fa_rnmextra" class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Normal</label>
                                        <jv-yesno uid="arnm_normal" :value="imageform.arnm_normal"
                                        @select="imageform.arnm_normal = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="!imageform.arnm_normal && imageform.fa_rnmextra" class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>ACD</label>
                                        <jv-yesno uid="arnm_acd" :value="imageform.arnm_acd"
                                        @select="imageform.arnm_acd = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="imageform.arnm_acd && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Oclusão - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_acdlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.arnm_acdlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_acd  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Oclusão - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_acdloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.arnm_acdloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_acd  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Estenose - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_acdestlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.arnm_acdestlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_acd  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_acdestloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.arnm_acdestloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_acd  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Grau:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_acdestgrau" :options="options['imageform.rnm_acdgrau']"
                                   @select="imageform.arnm_acdestgrau = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>


                            <div v-if="!imageform.arnm_normal && imageform.fa_rnmextra" class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>ACE</label>
                                        <jv-yesno uid="arnm_ace" :value="imageform.arnm_ace"
                                        @select="imageform.arnm_ace = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="imageform.arnm_ace  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Oclusão - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_acelado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.arnm_acelado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_ace && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Oclusão - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_aceloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.arnm_aceloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_ace && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Estenose - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_aceestlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.arnm_aceestlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_ace && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_aceestloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.arnm_aceestloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_ace  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Grau:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_aceestgrau" :options="options['imageform.rnm_acdgrau']"
                                   @select="imageform.arnm_aceestgrau = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="!imageform.arnm_normal && imageform.fa_rnmextra" class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>AVD</label>
                                        <jv-yesno uid="arnm_avd" :value="imageform.arnm_avd"
                                        @select="imageform.arnm_avd = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="imageform.arnm_avd  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Oclusão - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_avdlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.arnm_avdlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_avd && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Oclusão - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_avdloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.arnm_avdloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_avd && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Estenose - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_avdestlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.arnm_avdestlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_avd  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_avdestloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.arnm_avdestloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_avd  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Grau:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_avdestgrau" :options="options['imageform.rnm_acdgrau']"
                                   @select="imageform.arnm_avdestgrau = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="!imageform.arnm_normal && imageform.fa_rnmextra" class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>AVE</label>
                                        <jv-yesno uid="arnm_ave" :value="imageform.arnm_ave"
                                        @select="imageform.arnm_ave = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="imageform.arnm_ave  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Oclusão - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_avelado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.arnm_avelado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_ave  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Oclusão - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_aveloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.arnm_aveloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_ave  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Estenose - Lado:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_aveestlado" :options="options['imageform.rnm_acdlado']"
                                   @select="imageform.arnm_aveestlado = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_ave  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Localização:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_aveestloc" :options="options['imageform.rnm_acdloc']"
                                   @select="imageform.arnm_aveestloc = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>

                            <div v-if="imageform.arnm_ave  && !imageform.arnm_normal" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                   Estenose - Grau:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.arnm_aveestgrau" :options="options['imageform.rnm_acdgrau']"
                                   @select="imageform.arnm_aveestgrau = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
<!--
                            <div v-if="imageform.fa_atv" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Oclusão proximal de grande artéria:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_opga" :options="options['imageform.opga']" @select="imageform.rnm_opga = arguments[0]" :disabled="$verifyAccess(user)"></jv-select>
                            </div> -->

                            <div class="row form-group">
                                <div class="col-xs-12 col-sm-6">
                                    <label>DSA</label>
                                        <jv-yesno uid="dsanew" :value="imageform.dsanew"
                                        @select="imageform.dsanew = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>

                            <div v-if="imageform.dsanew" class="row form-group">
                                <div class="col-xs-12">
                                    <label>Observações</label>
                                    <textarea class="form-control" rows="5" v-model="imageform.dsanote" :disabled="$verifyAccess(user) && !verifyGroup()"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <legend>Investigação Completementar</legend>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Selecione:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_selec" :options="options['imageform.rnm_selec']"
                                   @select="imageform.rnm_selec = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Definição área de lesão</label>
                                        <jv-yesno uid="rnm_dal" :value="imageform.rnm_dal"
                                        @select="imageform.rnm_dal = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Craniotomia descompressiva</label>
                                        <jv-yesno uid="rnm_cd" :value="imageform.rnm_cd"
                                        @select="imageform.rnm_cd = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Efeito Tumofativo
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_et" :options="options['imageform.efeitotumofativo']"
                                   @select="imageform.rnm_et = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <label>Transfomação hemorrágica</label>
                                        <jv-yesno uid="avc_rnm_th" :value="imageform.avc_rnm_th"
                                        @select="imageform.avc_rnm_th = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                                </div>
                            </div>
                            <div v-if="imageform.avc_rnm_th" class="row form-group">
                                <label class="col-xs-12 col-sm-8">
                                    Selecione:
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="imageform.rnm_thop" :options="options['imageform.thop']" @select="imageform.rnm_thop = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>                          
                        </template>
                    </template>
                </template>
                <template>                
                    <div class="row">
                        <div class="col-xs-12">
                            <legend>Sistema de classificação causal para acidente vascular cerebral isquêmico (CCS)</legend>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            1. Avaliação de imagem do cérebro (verifique todos os que se aplicam):
                        </label>
                        <jv-check-group gid="imageform_css1" class="col-xs-12 col-sm-6" :value="imageform.css1"
                                        :options="options['imageform.css1']"
                                        @update="imageform.css1 = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-check-group>
                    </div>
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            2. Avaliação de imagem vascular cerebral (verifique todos os que se aplicam):
                        </label>
                        <jv-check-group gid="imageform_css2" class="col-xs-12 col-sm-6" :value="imageform.css2"
                                        :options="options['imageform.css2']"
                                        @update="imageform.css2 = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-check-group>
                    </div>
                    <div class="row form-group">
                        <label class="col-xs-12 col-sm-6">
                            3. Avaliação para o diagnóstico de outras causas (incomum) de acidente vascular cerebral (verifique todas as que se aplicam):
                        </label>
                        <jv-check-group gid="imageform_css3" class="col-xs-12 col-sm-6" :value="imageform.css3"
                                        :options="options['imageform.css3']"
                                        @update="imageform.css3 = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-check-group>
                    </div>
                </template>
                <div class="row form-group">
                    <div class="col-xs-6 col-sm-4">
                        <label>Foi realizado o upload da imagem?</label>
                            <jv-yesno uid="uploadimg" :value="imageform.uploadimg"
                                @select="imageform.uploadimg = arguments[0]" :disabled="$verifyAccess(user) && !verifyGroup()"></jv-yesno>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-sm-4">
                        <h5>Link para acesso as imagens:</h5>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
  import { mapState } from 'vuex'
  import _ from 'lodash'

  export default {
  computed: {
    ...mapState({
      imageform: state => state.followup.imageform,
      options: state => state.options,
      user: state => state.user,
      followup: state => state.followup,
      group: state => state.group
    })
  },
  methods: {
    verifyGroup(){
        if(this.group == "JOINVASC") {
            return true
        }
        if(this.group == this.followup.group) {
            return true
        } else {
            return false
        }
    }, 
  }
}
</script>
