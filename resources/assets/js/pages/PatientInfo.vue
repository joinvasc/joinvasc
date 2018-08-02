<template>
    <div class="panel panel-default">
        <div class="panel-heading">Cadastro de Dados do Paciente<span v-if="doFolowUp" style="color:red"> - {{msg}}</span></div>
        <div class="panel-body">
            <div class="row">
                <div class="form-group col-xs-12 col-sm-4">
                    <div class="required" >
                        <label>CPF</label>
                        <input class="form-control" type="number" :disabled="action === 'update'" v-model="followup.patient.cpf" onKeyPress="if(this.value.length==11) return false;">
                    </div>
                </div>

                <div class="form-group col-xs-12 col-sm-4">
                    <label>Data de Entrevista</label>
                    <jv-date :value="followup.interview_date"
                             @update="followup.interview_date = arguments[0]"
                             :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                </div>

                <div class="form-group col-xs-12 col-sm-4">
                    <label>Data de Admissão</label>
                    <jv-date :value="followup.admission_date"
                             type="datetime"
                             @update="followup.admission_date = arguments[0]"
                             :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                </div>

                <div class="required form-group col-xs-12 col-sm-8">
                    <label>Nome</label>
                    <input class="form-control" type="text" v-model="followup.patient.name" maxlength="255" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                </div>

                <div class="form-group col-xs-12 col-sm-4">
                    <label>Data de Nascimento</label>
                    <jv-date :value="followup.patient.birth_date"
                             @update="followup.patient.birth_date = arguments[0]"
                             :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                </div>
                
                <div class="form-group col-xs-12 col-sm-8">
                    <label>Número do Prontuário</label>
                    <input class="form-control" type="number" v-model="followup.patient.id" onKeyPress="if(this.value.length==11) return false;" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">  
                    <div class="nopadding radioOptions col-xs-12 col-sm-12">
                        <div class="nopadding col-xs-6 col-sm-6">
                        <label>Gênero</label>
                            <jv-radio-group gid="patient-info-patient-gender" :options="options['patient_info.patient_gender']"
                                            :value="followup.patient.gender"
                                            @update="followup.patient.gender = arguments[0]"
                                            :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                        </div>
                        <div class=" col-xs-6 col-sm-6">
                            <label>Tipo de Tratamento</label>
                            <jv-radio-group gid="patient-info-treatment-type" :options="options['patient_info.treatment_type']"
                                            :value="followup.treatment_type"
                                            @update="followup.treatment_type = arguments[0]"
                                            :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                        </div>
                       
                    </div>
                    <div class="nopadding ask col-xs-12 col-sm-8">
                            <label>Questionário respondido por:</label>
                            <jv-check-group gid="patient-info-telefone" class="col-xs-12 col-sm-12"
                                    :value="followup.patient.telefone"
                                    :options="options['patient_info.telefone']"
                                    @update="followup.patient.telefone = arguments[0]"
                                    :create="true"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group> 
                        </div>
                </div>
                 <div class="form-group col-xs-12 col-sm-4">
                    <label>Hospital</label>
                    <jv-radio-group gid="hospital" :options="options['hospitals']" :value="followup.hospital"
                                    @update="followup.hospital = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                </div>
                <div v-if="(followup.id != null)">
                    <div class="form-group col-xs-12 col-sm-12">
                        <label  class="nopadding col-xs-2 col-sm-2">
                            Arquivar registro?
                        </label>
                        <jv-yesno class="col-xs-10 col-sm-10" uid="patient" :value="followup.disabled"
                                @select="cleanReasonSelect();followup.disabled  = arguments[0]"
                                :disabled="followup.disabled == 3 || followup.disabled == 2 || user != 1" ></jv-yesno>
                    </div>

                    <div>
                        <div v-if="followup.disabled && followup.disabled != 2 && followup.disabled != 3" class="form-group" :disabled="isDisable()">
                        <label class="col-xs-1 col-sm-1">
                            Motivo:
                        </label>
                        <jv-select class="col-xs-4 col-sm-4" :value="followup.reason"
                                @select="followup.reason = arguments[0]"
                                :options="options['patient_info.disable_reason']"
                                :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                        </div>
                        <div v-if="followup.disabled == 3" class="form-group" :disabled="isDisable()" >
                        <label class="col-xs-1 col-sm-1">
                            Motivo:
                        </label>
                        <jv-select class="col-xs-4 col-sm-4" :value="newEvent" :disabled="isDisable()" 
                                 @select="newEvent"
                                :options="options['patient_info.disable_reason_new_event']"></jv-select>
                        </div>
                         <div v-if="followup.disabled == 2" class="form-group" :disabled="isDisable()" >
                        <label class="col-xs-1 col-sm-1">
                            Motivo:
                        </label>
                        <jv-select class="col-xs-4 col-sm-4" :value="deathReason" :disabled="isDisable()" 
                                 @select="deathReason"
                                :options="options['patient_info.disable_reason_death']"></jv-select>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
    </div>
</template>

<script type="application/ecmascript">
 // import { required, minLength, between } from 'vuelidate/lib/validators'
  import { mapState } from 'vuex'
  import axios from 'axios'

  export default {
    computed: {
      ...mapState({
        user: state => state.user,
        followup: state => state.followup,
        action: state => state.action,
        options: state => state.options,
        group: state => state.group
      }),
    },

    data() {
        return{
            newEvent: "patient-info-disable-reason-new-event-novo-evento",
            deathReason: "patient-info-disable-reason-death-obito",
            doFolowUp: false,
            msg: "",
            firstTime: true
        }
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
        isDisable(){
            return (this.followup.disabled != 0 && this.followup.disabled != null );
        },
        getSelectedReason(){
            
        },
        getDaysAfterLastAVC: function(){
            if(this.followup.current_event.event_datetime != null){
              
                var self = this;
                axios.post('verifyAmbulatoryCareData', {
                    id : self.followup.id
                })
                .then(function (response) {
                    self.doFolowUp = response.data.doFollowup;
                    self.msg = response.data.msg;
                })
                .catch(function (error) {
                });
            }
        },
        isFirst(){
            if (this.followup.id == null) {
                this.firstTime = true
            } else {
                 this.firstTime = false
            }
         },
         cleanReasonSelect(){
            this.followup.reason = null; 
         }
    },
    
    beforeMount(){
        this.getDaysAfterLastAVC()
    }
  }

  
</script>
<style>
.radioOptions{
   margin-top: 15px;
   margin-left: none;
}
.nopadding {
   padding-left: 0 !important;
   margin-left: 0 !important;
}
.ask{
    margin-top: 10px;
}

</style>
