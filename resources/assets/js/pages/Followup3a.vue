<template>
<div>
    <div v-if="status" class="panel panel-default">
        <div class="panel-heading">Followup - 3 ano</div>
		<div class="panel-body">
            <p class="text-center">Foi identificado o falecimento do paciente em followup anterior</p>
        </div>
    </div>
	<div v-else class="panel panel-default">
		<div class="panel-heading">Followup - 3 anos</div>
		<div class="panel-body">
			<div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Faz acompanhamento para o AVC?
                </label>
                <jv-check-group gid="avc_monitoring" class="col-xs-12 col-sm-4" :value="follow_obj.avc_monitoring"
                           :options="options['ambulatory_cares.avc_monitoring']"
                           @update="follow_obj.avc_monitoring = arguments[0]"
                           :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                </jv-check-group>
                <div class="col-xs-6 col-sm-2 row">
                    <jv-select :value="follow_obj.avc_monitoring_answer"
                    :options="options['ambulatory_cares.health_center_awnser']"
                    @select="follow_obj.avc_monitoring_answer = arguments[0]"
                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div> 
            </div>

            <div class="row form-group" v-if="follow_obj.avc_monitoring_answer == 'ambulatory-cares-health-center-awnser-sim'">
                <label class="col-xs-12 col-sm-8">Qual Especialidade?</label>
                <jv-check-group gid="first-event-med-details" class="col-xs-12 col-sm-4" :value="follow_obj.fuespecialities"
                        :options="options['first_event.med_details']" :create="true"
                        @update="follow_obj.fuespecialities = arguments[0]"
                        :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>
            
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    Frequência
                </label>
                <jv-select class="col-xs-12 col-sm-4 row" :value="follow_obj.frequency_health_center"
                           :options="options['demographic.healthcare_attendance']"
                           @select="follow_obj.frequency_health_center = arguments[0]"
                           :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
            </div>

            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    Reabilitação pós alta?
                </label>
                <div class="col-xs-12 col-sm-4">
                    <label for="physiotherapy" @click="follow_obj.physiotherapy = !(follow_obj.physiotherapy || false)">
                        <input type="checkbox" :id="uid" :checked="follow_obj.physiotherapy"
                         @change="follow_obj.physiotherapy = $event.target.checked" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"> <!-- HTML4.01 doctype --> 
                        <strong>{{follow_obj.physiotherapy? ' Sim': ' Não' }}</strong>                      
                    </label>
                </div>
            </div>

            <div class="row form-group" v-if="follow_obj.physiotherapy">
                <label class="col-xs-12 col-sm-8">Qual Especialidade?</label>
                <jv-check-group gid="first-event-rehab-details" class="col-xs-12 col-sm-4" :value="follow_obj.especialities"
                        :options="options['first_event.rehab_details']" :create="true"
                        @update="follow_obj.especialities = arguments[0]"
                        :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>

            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                   Valor da Hemoglobina Glicada
                </label>
                <div class="col-xs-6 col-sm-4">
                    <input class="form-control" type="text" placeholder="Valor" v-model="follow_obj.glycemic_Hemoglobin_value" maxlength="6" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                </div> 
                <div class="col-xs-6 col-sm-2 row">
                    <jv-select :value="follow_obj.glycemic_Hemoglobin_answer"
                            :options="options['risk_factors.diabetes_hemoglobin_hba1c']"
                            @select="follow_obj.glycemic_Hemoglobin_answer = arguments[0]"
                            :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div> 
                <!-- <div class="col-xs-12 col-sm-4">
                    <div class="row col-md-6">
                        <input class="form-control" type="text" placeholder="Valor" v-model="follow_obj.glycemic_Hemoglobin_value">
                    </div>
                    <jv-select class="row col-md-6" :value="follow_obj.glycemic_Hemoglobin_answer"
                            :options="options['ambulatory_cares.glycemic_Hemoglobin_answer']"
                            @select="follow_obj.glycemic_Hemoglobin_answer = arguments[0]"></jv-select>
                </div> -->
            </div>
            
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                   Valor do colesterol LDL: (&lt;75)
                </label>
                <div class="col-xs-6 col-sm-4">
                    <input class="form-control" type="text" placeholder="Valor" v-model="follow_obj.ldl_value" maxlength="6" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                </div> 
                <div class="col-xs-6 col-sm-2 row">
                    <jv-select  :value="follow_obj.ldl_answer"
                            :options="options['risk_factors.diabetes_hemoglobin_hba1c']"
                            @select="follow_obj.ldl_answer = arguments[0]"
                            :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div> 
            </div>

            <div class="row form-group pa-admission">
                <label class="col-xs-12 col-sm-6">
                    Pressão arterial (PA > 140/90)
                </label>

                <div class="col-xs-6 col-sm-4 inputs">
                    <div class="input-group pull-left">
                        <input type="text" class="form-control" v-model="follow_obj.blood_pressure[0]" maxlength="3" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        <span class="input-group-addon">x</span>
                    </div>
                    <div class="input-group pull-left">
                        <input type="text" class="form-control" v-model="follow_obj.blood_pressure[1]" maxlength="3" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                        <span class="input-group-addon">mHg</span>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-2 row">
                    <jv-select  :value="follow_obj.blood_pressure_answer"
                            :options="options['risk_factors.diabetes_hemoglobin_hba1c']"
                            @select="follow_obj.blood_pressure_answer = arguments[0]"
                            :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div> 
            </div>

            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Tabagismo
                </label>
                <jv-select class="col-xs-12 col-sm-6 row" :value="follow_obj.smoking"
                           :options="options['risk_factors.smoking']"
                           @select="follow_obj.smoking = arguments[0]"
                           :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Rankin <a href="https://en.wikipedia.org/wiki/Modified_Rankin_Scale" target="_blank">O que significa?</a>
                </label>
                <!-- <jv-select class="col-xs-12 col-sm-6 row" :value="follow_obj.follow_rankin30"
                           :options="options['discharge.rankin']"
                           @select="follow_obj.follow_rankin30 = arguments[0]"></jv-select> -->
                <jv-rankin class="col-xs-12 col-sm-6 row" :value="follow_obj.follow_rankin30" 
                :options="follow_obj.rankin_options" :time="page" @select="follow_obj.follow_rankin30 = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-rankin>
            </div>
            <div class="row form-group">
                <div class="col-xs-12">
                    <label>Nome do posto</label>
                    <textarea class="form-control" rows="1" v-model="follow_obj.postname" maxlength="50" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></textarea>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-xs-12">
                    <label>Observações</label>
                    <textarea class="form-control" rows="5" v-model="follow_obj.note" maxlength="255" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></textarea>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Número de crises no período
                </label>
                <jv-select class="col-xs-12 col-sm-6 row" :value="follow_obj.nbperiods"
                           :options="options['demographic.nbperiods']"
                           @select="follow_obj.nbperiods = arguments[0]"
                           :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Presença de crises com generalização tônico-clônica
                </label>
                <jv-yesno class="col-xs-12 col-sm-6" uid="presencacrises"
                    :value="follow_obj.presencacrises"
                    @select="follow_obj.presencacrises = arguments[0]"
                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Uso de medicação anti-epilética
                </label>
                <jv-yesno class="col-xs-12 col-sm-6" uid="antiepiletic"
                    :value="follow_obj.antiepiletic"
                    @select="follow_obj.antiepiletic = arguments[0]"
                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { mapState, mapActions } from "vuex";
import _ from "lodash";

export default {
  computed: {
    ...mapState({
      follow_obj: state => state.followup.ambulatory_care.follow3a,
      options: state => state.options,
      user: state => state.user,
      followup: state => state.followup,
      group: state => state.group
    })

    // place functions here
  },
  data() {
    return {
      page: 'followup3a',
      status: null
    };
  },
  mounted() {
    this.verifica()
  },
  methods: {
      ...mapActions([
          'updateDead'
    ]),
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
      verifica(){
          self = this
          return this.updateDead({
              when: this.page
          }).then(data=>{
              this.status = data
          })
      }
  }
};
</script>
<style scoped>
    .pa-admission .input-group {
        width: 50%;
    }

    .pa-admission .input-group:first-child > .input-group-addon {
        border-radius: 0;
    }

    .pa-admission .input-group:nth-child(2) > .form-control {
        border-radius: 0;
    }
</style>