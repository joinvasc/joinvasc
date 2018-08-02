<template>
    <div class="panel panel-default">
        <div class="panel-heading">Biobanco</div>
            <ul class="nav nav-tabs menu" id="menu">
                <li><a href="#biobase" data-toggle="tab" class="teste">Biobanco</a></li>
                <li v-visible="followup.biobase.control_1.code"><a href="#control1" data-toggle="tab">Controle 1<a @click="hide(followup.biobase.control_1)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>
                <li v-visible="followup.biobase.control_2.code"><a href="#control2" data-toggle="tab">Controle 2<a @click="hide(followup.biobase.control_2)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>
                <li v-visible="followup.biobase.control_3.code"><a href="#control3" data-toggle="tab">Controle 3<a @click="hide(followup.biobase.control_3)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>
                <li v-visible="followup.biobase.control_4.code"><a href="#control4" data-toggle="tab">Controle 4<a @click="hide(followup.biobase.control_4)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>
                <li v-visible="followup.biobase.control_5.code"><a href="#control5" data-toggle="tab">Controle 5<a @click="hide(followup.biobase.control_5)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>
                <a href="#" @click="show()" id="btnAdd" v-if="followup.biobase.control_5.code != 5" data-toggle="tab"><i class="biobase glyphicon glyphicon-plus"></i></a>
            </ul>
            <div class="panel-body">
            <div class="tab-content">
                <div class="tab-pane in active" id="biobase">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data da Coleta</label>
                            <jv-date :value="followup.biobase.receipt_date"
                                    @update="followup.biobase.receipt_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data da Extração do DNA</label>
                            <jv-date :value="followup.biobase.extraction_date"
                                    @update="followup.biobase.extraction_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data de Armazenamento</label>
                            <jv-date :value="followup.biobase.storage_date"
                                    @update="followup.biobase.storage_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6">
                            <div class="required">
                                <label>Quantificação DNA</label>
                                <input class="form-control" type="number" :disabled="action === 'update'" v-model="followup.biobase.dna_quantification" onKeyPress="if(this.value.length==10) return false;">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-6">
                            <label>Localização no Freezer</label>
                            <input type="text" class="form-control" v-model="followup.biobase.freezer_location" maxlength="40" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="row form-group">
                            <div class="col-xs-12">
                                <label>Observações</label>
                                <textarea class="form-control" rows="5" v-model="followup.biobase.note" maxlength="255" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="control1">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data de Nascimento</label>
                            <jv-date :value="followup.biobase.control_1.born_date"
                                    @update="followup.biobase.control_1.born_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data da entrevista</label>
                            <jv-date :value="followup.biobase.control_1.interview_date"
                                    @update="followup.biobase.control_1.interview_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group">
                                <label class="col-xs-12 col-sm-4">
                                    Grau de parentesco
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="followup.biobase.control_1.kinship"
                                        :options="options['biobase.relationship']"
                                        @select="followup.biobase.control_1.kinship = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-8">
                            <div class="required" >
                                <label>Nome</label>
                                <input type="text" class="form-control" v-model="followup.biobase.control_1.name" maxlength="40" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Raça</label>
                            <jv-select :value="followup.biobase.control_1.race" @select="followup.biobase.control_1.race = arguments[0]"
                                    :options="options['demographic.race']" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        
                        <div class=" row form-group col-xs-4 col-sm-4">
                            <label>Gênero</label>
                                <jv-radio-group gid="patient-info-patient-gender_1" :options="options['patient_info.patient_gender']"
                                    :value="followup.biobase.control_1.gender"
                                    @update="followup.biobase.control_1.gender = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="lead">Demográfico</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-3">
                            <label>CEP</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_1.cep" v-mask="'#####-###'" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-9 col-sm-7">
                            <label>Endereço</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_1.address" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-3 col-sm-2">
                            <label>Nº</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_1.number" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6">
                            <label>Bairro</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_1.neighborhood" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Ponto de referência</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_1.reference" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>

                    <hr>  

                    <div class="row form-group">
                            <div class="col-xs-12">
                                <p class="lead">Fatores de risco</p>
                            </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Parente com AVC?
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_1.avc"
                                    :options="options['risk_factors.has_hypertension']"
                                    @select="followup.biobase.control_1.avc = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <template v-if="followup.biobase.control_1.avc && followup.biobase.control_1.avc.includes('sim')">
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-6">
                                    Quem?
                                </label>
                                <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_1.kindred_avc"
                                    :options="options['biobase.who']"
                                    @select="followup.biobase.control_1.kindred_avc = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                        </template>

                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Hipertensão
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_1.hypertension"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_1.hypertension = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Diabetes Mellitus
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_1.diabetes"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_1.diabetes = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Dislipidemia
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_1.dyslipidemia"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_1.dyslipidemia = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Tabagismo
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_1.smoking"
                                    :options="options['risk_factors.smoking']"
                                    @select="followup.biobase.control_1.smoking = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Cardiopatia
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_1.cardiopathy"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_1.cardiopathy = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <template v-if="followup.biobase.control_1.cardiopathy && followup.biobase.control_1.cardiopathy.includes('sim')">
                        <div class="form-group col-xs-12 col-sm-12">
                                <label class="col-xs-12 col-sm-6">Qual?</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class=" form-control" v-model="followup.biobase.control_1.cardiopathy_description" maxlength="60" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                                </div>
                        </div>
                        </template>
                        

                    </div>  
                </div>


                <div class="tab-pane" id="control2">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data de Nascimento</label>
                            <jv-date :value="followup.biobase.control_2.born_date"
                                    @update="followup.biobase.control_2.born_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data da entrevista</label>
                            <jv-date :value="followup.biobase.control_2.interview_date"
                                    @update="followup.biobase.control_2.interview_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group">
                                <label class="col-xs-12 col-sm-4">
                                    Grau de parentesco
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="followup.biobase.control_2.kinship"
                                        :options="options['biobase.relationship']"
                                        @select="followup.biobase.control_2.kinship = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-8">
                            <div class="required" >
                                <label>Nome</label>
                                <input type="text" class="form-control" v-model="followup.biobase.control_2.name" maxlength="40" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Raça</label>
                            <jv-select :value="followup.biobase.control_2.race" @select="followup.biobase.control_2.race = arguments[0]"
                                    :options="options['demographic.race']" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        
                        <div class=" row form-group col-xs-4 col-sm-4">
                            <label>Gênero</label>
                                <jv-radio-group gid="patient-info-patient-gender_2" :options="options['patient_info.patient_gender']"
                                    :value="followup.biobase.control_2.gender"
                                    @update="followup.biobase.control_2.gender = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="lead">Demográfico</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-3">
                            <label>CEP</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_2.cep" v-mask="'#####-###'" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-9 col-sm-7">
                            <label>Endereço</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_2.addresss" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-3 col-sm-2">
                            <label>Nº</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_2.number" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6">
                            <label>Bairro</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_2.neighborhood" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Ponto de referência</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_2.reference" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>

                    <hr>  

                    <div class="row form-group">
                            <div class="col-xs-12">
                                <p class="lead">Fatores de risco</p>
                            </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Parente com AVC?
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_2.avc"
                                    :options="options['risk_factors.has_hypertension']"
                                    @select="followup.biobase.control_2.avc = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <template v-if="followup.biobase.control_2.avc && followup.biobase.control_2.avc.includes('sim')">
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-6">
                                    Quem?
                                </label>
                                <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_2.kindred_avc"
                                    :options="options['biobase.who']"
                                    @select="followup.biobase.control_2.kindred_avc = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                        </template>

                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Hipertensão
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_2.hypertension"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_2.hypertension = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Diabetes Mellitus
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_2.diabetes"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_2.diabetes = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Dislipidemia
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_2.dyslipidemia"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_2.dyslipidemia = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Tabagismo
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_2.smoking"
                                    :options="options['risk_factors.smoking']"
                                    @select="followup.biobase.control_2.smoking = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Cardiopatia
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_2.cardiopathy"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_2.cardiopathy = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <template v-if="followup.biobase.control_2.cardiopathy && followup.biobase.control_2.cardiopathy.includes('sim')">
                        <div class="form-group col-xs-12 col-sm-12">
                                <label class="col-xs-12 col-sm-6">Qual?</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class=" form-control" v-model="followup.biobase.control_2.cardiopathy_description" maxlength="60" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                                </div>
                        </div>
                        </template>
                    </div>
                </div>

                <div class="tab-pane" id="control3">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data de Nascimento</label>
                            <jv-date :value="followup.biobase.control_3.born_date"
                                    @update="followup.biobase.control_3.born_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data da entrevista</label>
                            <jv-date :value="followup.biobase.control_3.interview_date"
                                    @update="followup.biobase.control_3.interview_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group">
                                <label class="col-xs-12 col-sm-4">
                                    Grau de parentesco
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="followup.biobase.control_3.kinship"
                                        :options="options['biobase.relationship']"
                                        @select="followup.biobase.control_3.kinship = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-8">
                            <div class="required" >
                                <label>Nome</label>
                                <input type="text" class="form-control" v-model="followup.biobase.control_3.name" maxlength="40" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Raça</label>
                            <jv-select :value="followup.biobase.control_3.race" @select="followup.biobase.control_3.race = arguments[0]"
                                    :options="options['demographic.race']" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        
                        <div class=" row form-group col-xs-4 col-sm-4">
                            <label>Gênero</label>
                                <jv-radio-group gid="patient-info-patient-gender_3" :options="options['patient_info.patient_gender']"
                                    :value="followup.biobase.control_3.gender"
                                    @update="followup.biobase.control_3.gender = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="lead">Demográfico</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-3">
                            <label>CEP</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_3.cep" v-mask="'#####-###'" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-9 col-sm-7">
                            <label>Endereço</label>
                            <input type="text" class="form-control"  v-model="followup.biobase.control_3.addresss" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-3 col-sm-2">
                            <label>Nº</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_3.number" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6">
                            <label>Bairro</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_3.neighborhood" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Ponto de referência</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_3.reference" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>

                    <hr>  

                    <div class="row form-group">
                            <div class="col-xs-12">
                                <p class="lead">Fatores de risco</p>
                            </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Parente com AVC?
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_3.avc"
                                    :options="options['risk_factors.has_hypertension']"
                                    @select="followup.biobase.control_3.avc = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <template v-if="followup.biobase.control_3.avc && followup.biobase.control_3.avc.includes('sim')">
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-6">
                                    Quem?
                                </label>
                                <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_3.kindred_avc"
                                    :options="options['biobase.who']"
                                    @select="followup.biobase.control_3.kindred_avc = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                        </template>

                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Hipertensão
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_3.hypertension"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_3.hypertension = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Diabetes Mellitus
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_3.diabetes"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_3.diabetes = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Dislipidemia
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_3.dyslipidemia"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_3.dyslipidemia = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Tabagismo
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_3.smoking"
                                    :options="options['risk_factors.smoking']"
                                    @select="followup.biobase.control_3.smoking = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Cardiopatia
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_3.cardiopathy"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_3.cardiopathy = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <template v-if="followup.biobase.control_3.cardiopathy && followup.biobase.control_3.cardiopathy.includes('sim')">
                        <div class="form-group col-xs-12 col-sm-12">
                                <label class="col-xs-12 col-sm-6">Qual?</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class=" form-control" v-model="followup.biobase.control_3.cardiopathy_description" maxlength="60" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                                </div>
                        </div>
                        </template>
                    </div>
                </div>


                <div class="tab-pane" id="control4">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data de Nascimento</label>
                            <jv-date :value="followup.biobase.control_4.born_date"
                                    @update="followup.biobase.control_4.born_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data da entrevista</label>
                            <jv-date :value="followup.biobase.control_4.interview_date"
                                    @update="followup.biobase.control_4.interview_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group">
                                <label class="col-xs-12 col-sm-4">
                                    Grau de parentesco
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="followup.biobase.control_4.kinship"
                                        :options="options['biobase.relationship']"
                                        @select="followup.biobase.control_4.kinship = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-8">
                            <div class="required" >
                                <label>Nome</label>
                                <input type="text" class="form-control" v-model="followup.biobase.control_4.name" maxlength="40" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Raça</label>
                            <jv-select :value="followup.biobase.control_4.race" @select="followup.biobase.control_4.race = arguments[0]"
                                    :options="options['demographic.race']" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        
                        <div class=" row form-group col-xs-4 col-sm-4">
                            <label>Gênero</label>
                                <jv-radio-group gid="patient-info-patient-gender_4" :options="options['patient_info.patient_gender']"
                                    :value="followup.biobase.control_4.gender"
                                    @update="followup.biobase.control_4.gender = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="lead">Demográfico</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-3">
                            <label>CEP</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_4.cep" v-mask="'#####-###'" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-9 col-sm-7">
                            <label>Endereço</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_4.addresss" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-3 col-sm-2">
                            <label>Nº</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_4.number" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6">
                            <label>Bairro</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_4.neighborhood" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Ponto de referência</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_4.reference" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>

                    <hr>  

                    <div class="row form-group">
                            <div class="col-xs-12">
                                <p class="lead">Fatores de risco</p>
                            </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Parente com AVC?
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_4.avc"
                                    :options="options['risk_factors.has_hypertension']"
                                    @select="followup.biobase.control_4.avc = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <template v-if="followup.biobase.control_4.avc && followup.biobase.control_4.avc.includes('sim')">
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-6">
                                    Quem?
                                </label>
                                <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_4.kindred_avc"
                                    :options="options['biobase.who']"
                                    @select="followup.biobase.control_4.kindred_avc = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                        </template>

                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Hipertensão
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_4.hypertension"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_4.hypertension = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Diabetes Mellitus
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_4.diabetes"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_4.diabetes = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Dislipidemia
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_4.dyslipidemia"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_4.dyslipidemia = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Tabagismo
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_4.smoking"
                                    :options="options['risk_factors.smoking']"
                                    @select="followup.biobase.control_4.smoking = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Cardiopatia
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_4.cardiopathy"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_4.cardiopathy = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <template v-if="followup.biobase.control_4.cardiopathy && followup.biobase.control_4.cardiopathy.includes('sim')">
                        <div class="form-group col-xs-12 col-sm-12">
                                <label class="col-xs-12 col-sm-6">Qual?</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class=" form-control" v-model="followup.biobase.control_4.cardiopathy_description" maxlength="60" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                                </div>
                        </div>
                        </template>
                    </div>
                </div>

                <div class="tab-pane" id="control5">
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data de Nascimento</label>
                            <jv-date :value="followup.biobase.control_5.born_date"
                                    @update="followup.biobase.control_5.born_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Data da entrevista</label>
                            <jv-date :value="followup.biobase.control_5.interview_date"
                                    @update="followup.biobase.control_5.interview_date = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                        </div>
                        <div class="form-group">
                                <label class="col-xs-12 col-sm-4">
                                    Grau de parentesco
                                </label>
                                <jv-select class="col-xs-12 col-sm-4" :value="followup.biobase.control_5.kinship"
                                        :options="options['biobase.relationship']"
                                        @select="followup.biobase.control_5.kinship = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="form-group col-xs-12 col-sm-8">
                            <div class="required" >
                                <label>Nome</label>
                                <input type="text" class="form-control" v-model="followup.biobase.control_5.name" maxlength="40" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-sm-4">
                            <label>Raça</label>
                            <jv-select :value="followup.biobase.control_5.race" @select="followup.biobase.control_5.race = arguments[0]"
                                    :options="options['demographic.race']" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        
                        <div class=" row form-group col-xs-4 col-sm-4">
                            <label>Gênero</label>
                                <jv-radio-group gid="patient-info-patient-gender_5" :options="options['patient_info.patient_gender']"
                                    :value="followup.biobase.control_5.gender"
                                    @update="followup.biobase.control_5.gender = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="lead">Demográfico</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-3">
                            <label>CEP</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_5.cep" v-mask="'#####-###'" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-9 col-sm-7">
                            <label>Endereço</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_5.addresss" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-3 col-sm-2">
                            <label>Nº</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_5.number" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6">
                            <label>Bairro</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_5.neighborhood" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Ponto de referência</label>
                            <input type="text" class="form-control" v-model="followup.biobase.control_5.reference" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        </div>
                    </div>

                    <hr>  

                    <div class="row form-group">
                            <div class="col-xs-12">
                                <p class="lead">Fatores de risco</p>
                            </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Parente com AVC?
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_5.avc"
                                    :options="options['risk_factors.has_hypertension']"
                                    @select="followup.biobase.control_5.avc = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <template v-if="followup.biobase.control_5.avc && followup.biobase.control_5.avc.includes('sim')">
                            <div class="row form-group">
                                <label class="col-xs-12 col-sm-6">
                                    Quem?
                                </label>
                                <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_5.kindred_avc"
                                    :options="options['biobase.who']"
                                    @select="followup.biobase.control_5.kindred_avc = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                            </div>
                        </template>

                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Hipertensão
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_5.hypertension"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_5.hypertension = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Diabetes Mellitus
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_5.diabetes"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_5.diabetes = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Dislipidemia
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_5.dyslipidemia"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_5.dyslipidemia = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Tabagismo
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_5.smoking"
                                    :options="options['risk_factors.smoking']"
                                    @select="followup.biobase.control_5.smoking = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div class="row form-group">
                            <label class="col-xs-12 col-sm-6">
                                Cardiopatia
                            </label>
                            <jv-select class="col-xs-12 col-sm-6" :value="followup.biobase.control_5.cardiopathy"
                                    :options="options['biobase.yesno']"
                                    @select="followup.biobase.control_5.cardiopathy = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <template v-if="followup.biobase.control_5.cardiopathy && followup.biobase.control_5.cardiopathy.includes('sim')">
                        <div class="form-group col-xs-12 col-sm-12">
                                <label class="col-xs-12 col-sm-6">Qual?</label>
                                <div class="col-xs-12 col-sm-6">
                                    <input type="text" class=" form-control" v-model="followup.biobase.control_5.cardiopathy_description" maxlength="60" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                                </div>
                        </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
        <v-dialog/>
    </div>
</template>
<style>
.biobase.glyphicon-remove:before {
    margin-left: 4px;
    margin-top: -24px;
    position: absolute;
    font-size: 8px;
}

.biobase.glyphicon-plus {
    margin-top: 12px;
}
</style>

<script>
  import { mapState } from 'vuex'
  import axios from 'axios'

  export default {
    computed: {
      ...mapState({
        followup: state => state.followup,
        options: state => state.options,
        user: state => state.user,
        group: state => state.group
      })
    },
    props:{
    },
    methods:{
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
      createControl(){
        if (this.followup.biobase.control_1.code == null) {
            this.followup.biobase.control_1.code = 1;
            //this.addControl(1);
            return
        }
        if (this.followup.biobase.control_2.code == null) {
            this.followup.biobase.control_2.code = 2;
            //this.addControl(2);
            return
        }
        if (this.followup.biobase.control_3.code == null) {
            this.followup.biobase.control_3.code = 3;
            //this.addControl(3);
            return
        }
        if (this.followup.biobase.control_4.code == null) {
            this.followup.biobase.control_4.code = 4;
            //this.addControl(4);
            return
        }
        if (this.followup.biobase.control_5.code == null) {
            this.followup.biobase.control_5.code = 5;
            //this.addControl(5);
            return
        }
      },
      deleteControl(control){
           for (var key in control) {
                control[key] = null;
            }
      },
      show(code) {;
        this.$modal.show('dialog', {
            title: 'Biobanco',
            text: 'Deseja criar um novo controle?',
            buttons: [
            {
                title: 'Sim',
                handler: () =>  {this.createControl(); this.$modal.hide('dialog')} 
            },
            {       
                title: 'Não'
            }
            ]
        })
      },
      hide(control) {
        this.$modal.show('dialog', {
            title: 'Biobanco',
            text: 'Deseja excluir esse controle?',
            buttons: [
            {
                title: 'Sim',
                handler: () => {this.deleteControl(control);this.$modal.hide('dialog') }
            },
            {
                title: 'Não'
            }
            ]
        })
      },
      beforeMounted() {
          /*
         if (this.followup.biobase.control_1.code != 1) {
              $('.menu').append('<li v-visible="followup.biobase.control_1.code"><a href="#control1" data-toggle="tab">Controle 1<a @click="hide(followup.biobase.control_1)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>');
          }
          if (this.followup.biobase.control_2.code != 2) {
              $('.menu').append('<li v-visible="followup.biobase.control_2.code"><a href="#control2" data-toggle="tab">Controle 2<a @click="hide(followup.biobase.control_2)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>');
          }
          if (this.followup.biobase.control_3.code != 3) {
              $('.menu').append('<li v-visible="followup.biobase.control_3.code"><a href="#control3" data-toggle="tab">Controle 3<a @click="hide(followup.biobase.control_3)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>');
          }
          if (this.followup.biobase.control_4.code != 4) {
              $('.menu').append('<li v-visible="followup.biobase.control_4.code"><a href="#control4" data-toggle="tab">Controle 4<a @click="hide(followup.biobase.control_4)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>');
          }
          if (this.followup.biobase.control_5.code != 5) {
              $('.menu').append('<li v-visible="followup.biobase.control_5.code"><a href="#control5" data-toggle="tab">Controle 5<a @click="hide(followup.biobase.control_5)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>');
          } */
        },
        addControl(value) {
            switch(value) 
            {
                case 1:
                    $('<li v-visible="followup.biobase.control_1.code"><a href="#control1" data-toggle="tab">Controle 1<a @click="hide(followup.biobase.control_1)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>').appendTo(".menu");
                    break;
                case 2:
                    $('.menu').append('<li v-visible="followup.biobase.control_2.code"><a href="#control2" data-toggle="tab">Controle 2<a @click="hide(followup.biobase.control_2)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>');
                    break;
                case 3:
                    $('.menu').append('<li v-visible="followup.biobase.control_3.code"><a href="#control3" data-toggle="tab">Controle 3<a @click="hide(followup.biobase.control_3)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>');
                    break;
                case 4:
                    $('.menu').append('<li v-visible="followup.biobase.control_4.code"><a href="#control4" data-toggle="tab">Controle 4<a @click="hide(followup.biobase.control_4)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>');
                    break;
                case 5:
                    $('.menu').append('<li v-visible="followup.biobase.control_5.code"><a href="#control5" data-toggle="tab">Controle 5<a @click="hide(followup.biobase.control_5)"><i class="biobase glyphicon glyphicon-remove"></i></a></a></li>');
                    break;
                default:
                    break;
            }
        },
        removeControl() {

        },
        mounted(){
            $('span').on('click', function(){
                alert("arroz");
            });
        }
     } 
  }
</script>

