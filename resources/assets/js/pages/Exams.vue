<template>
    <div class="panel panel-default">
        <div class="panel-heading">Campo II: Exames</div>
        <div class="panel-body">
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    Escala de diagnóstico de Banford
                </label>
                <jv-check-group class="col-xs-12 col-sm-4" :gid="banford"  :value="exams.banford" :options="options['exams.banford']"
                           @update="exams.banford = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <legend>Escala na admissão</legend>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    NIH (0 - 42)
                </label>
                <div class="col-xs-12 col-sm-4">
                    <input type="text" class="form-control" :value="exams.nih"
                           @input="checkNIH($event.target.value)" maxlength="2" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">

                </div>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    Ranking prévio
                </label>
                <jv-select class="col-xs-12 col-sm-4" :value="exams.previous_rankin"
                           :options="options['exams.previous_rankin']"
                           @select="exams.previous_rankin = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    Ranking na admissão
                </label>
                <jv-select class="col-xs-12 col-sm-4" :value="exams.admission_rankin"
                           :options="options['exams.admission_rankin']"
                           @select="exams.admission_rankin = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    Barthel até 48h da admissão (0 - 100)
                </label>
                <div class="col-xs-12 col-sm-4">
                    <input type="text" class="form-control" :value="exams.barthel"
                           @input="checkBarthel($event.target.value)" maxlength="3" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <legend>Exames</legend>
                </div>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                </label>
                <jv-check-group gid="exams_list" class="col-xs-12 col-sm-6" :value="exams.list"
                                :options="options['exams.exams_list']"
                                @update="exams.list = arguments[0]"
                                :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>

            <jv-laboratory-exam exam="fasting_blood_glicose" :isFirst="isFirst" :maxlength="4" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()" >Glicemia de Jejum</jv-laboratory-exam>
            <jv-laboratory-exam exam="triglycerides" :isFirst="isFirst" :maxlength="4" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">Triglicerídeos</jv-laboratory-exam>
            <jv-laboratory-exam exam="total_cholesterol" :isFirst="isFirst" :maxlength="4" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">Colesterol Total</jv-laboratory-exam>
            <jv-laboratory-exam exam="hdl" :isFirst="isFirst" :maxlength="4" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">HDL</jv-laboratory-exam>
            <jv-laboratory-exam exam="ldl" :isFirst="isFirst" :maxlength="4" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">LDL</jv-laboratory-exam>
            <jv-laboratory-exam exam="uric_acid" :isFirst="isFirst" :maxlength="4" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">Ácido Úrico</jv-laboratory-exam>
            <jv-laboratory-exam exam="creatinine" :isFirst="isFirst" :maxlength="4" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">Creatinina</jv-laboratory-exam>
            <jv-laboratory-exam exam="vhs" :isFirst="isFirst" :maxlength="4" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">VHS</jv-laboratory-exam>
            <jv-laboratory-exam exam="ecg" :options="options['exams.ecg']" :create="true" :isFirst="isFirst" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">ECG</jv-laboratory-exam>

            <div class="row form-group" v-if="exams.ecg == 'exams-ecg-outros'">
                <div class="form-group col-xs-12 col-sm-12">
                    <label class="col-xs-12 col-sm-6">
                        Descrição
                    </label>
                    <div class="col-xs-12 col-sm-6">
                        <input type="text" class="form-control" v-model="exams.ecg_description" maxlength="40" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    </div>
                </div>
            </div>
            
            <jv-laboratory-exam exam="actilyise" :options="options['exams.actilyise']" :isFirst="isFirst" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"> Trombolítico (Actilyise) </jv-laboratory-exam>
             

            <div class="row form-group">
                <label class="col-xs-6 col-sm-6">
                    Trombolítico <br>
                    <small>Data e horário</small>
                </label>
                <jv-date class="col-xs-6 col-sm-6" :value=" (!exams.actilyise)? '' : exams.actilyise_date"
                         type="datetime" :disabled="!exams.actilyise || (action === 'update' && $verifyAccess(user) && !verifyGroup())"
                         @update="exams.actilyise_date = arguments[0]" ></jv-date>
            </div>

            <div class="row form-group pa-admission">
                <label class="col-xs-12 col-sm-4">
                    Nível PA na Admissão
                </label>
                <div class="col-xs-6 col-sm-2">
                    <jv-yesno uid="admission_pa" :value="admission_pa_status"
                              @select="updateStatus(arguments[0])" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                </div>
                <div class="col-xs-6 col-sm-6 inputs">
                    <div class="input-group pull-left">
                        <input type="text" :disabled="!admission_pa_status  || ($verifyAccess(user) && !verifyGroup())" class="form-control" v-model="exams.admission_pa[0]" maxlength="3" >
                        <span class="input-group-addon">x</span>
                    </div>
                    <div class="input-group pull-left">
                        <input type="text" class="form-control" v-model="exams.admission_pa[1]" :disabled="!admission_pa_status  || (action === 'update' && $verifyAccess(user) && !verifyGroup())" maxlength="3">
                        <span class="input-group-addon">mHg</span>
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-xs-12 col-sm-4">
                    Tomografia <br>
                    <small>Data e horário</small>
                </label>
                <div class="col-xs-6 col-sm-2">
                    <jv-yesno uid="tomography_datetime" :value="tomography_datetime_status"
                              @select="updateTomography()" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                </div>
                <jv-date class="col-xs-6 col-sm-6" :value="exams.tomography_datetime"
                         type="datetime" :disabled="!tomography_datetime_status || (action === 'update' && $verifyAccess(user) && !verifyGroup())"
                         @update="exams.tomography_datetime = arguments[0]"></jv-date>
            </div>
            <jv-laboratory-exam exam="holter24" :inputDate="true" :isFirst="isFirst" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">Holter 24 Horas</jv-laboratory-exam>
            <jv-laboratory-exam exam="holter3" :inputDate="true" :isFirst="isFirst" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">Holter 3 dias</jv-laboratory-exam>
            <jv-laboratory-exam exam="holter7" :inputDate="true" :isFirst="isFirst" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">Holter 7 dias</jv-laboratory-exam>
            <div class="row form-group">
                <label for="" class="col-xs-6 col-sm-4">
                    Holter prolongado com telemetria
                </label>
                <jv-yesno class="col-xs-12 col-sm-4" uid="telemetry_holter" :value="telemetry_holter_status"
                            @select="cleanHolter" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
            </div>
            <div v-if="telemetry_holter_status" class="row form-group">
                <div class="col-xs-12">
                    <label>Observações</label>
                    <textarea class="form-control" rows="5" v-model="exams.note_telemetry_holter" maxlength="255" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></textarea>
                </div>
            </div>

            <div class="row form-group">
                <label for="" class="col-xs-6 col-sm-4">
                    Ecocardiograma transtorácico
                </label>
                <jv-yesno class="col-xs-6 col-sm-2" uid="echocardiogram_transthoracic" :value="echocardiogram_transthoracic_yesno"
                            @select="cleanTransthoracic(echocardiogram_transthoracic_yesno)" :disabled="action === 'update' && $verifyAccess(user)"></jv-yesno>
                <jv-date class="col-xs-6 col-sm-6" :value="exams.echocardiogram_transthoracic" :disabled="echocardiogramDisableTransthoracic(echocardiogram_transthoracic_yesno) || (action === 'update' && $verifyAccess(user) && !verifyGroup())"
                             @update="exams.echocardiogram_transthoracic = arguments[0]"></jv-date>
            </div>
            <div class="row form-group">
                <label for="" class="col-xs-6 col-sm-4">
                    Ecocardiograma transesofágico
                </label>
                <jv-yesno class="col-xs-6 col-sm-2" uid="echocardiogram_transesophageal" :value="echocardiogram_transesophageal_yesno"
                            @select="cleanTransesophageal(echocardiogram_transesophageal_yesno)"></jv-yesno>
                <jv-date class="col-xs-6 col-sm-6" :value="exams.echocardiogram_transesophageal" :disabled="echocardiogramDisableTransesophageal(echocardiogram_transesophageal_yesno) || (action === 'update' && $verifyAccess(user) && !verifyGroup())"
                             @update="exams.echocardiogram_transesophageal = arguments[0]"></jv-date>
            </div>
            <div v-if="echocardiogram_transthoracic_yesno || echocardiogram_transesophageal_yesno" class="row form-group">
                <div class="col-xs-12">
                    <label>Observações</label>
                    <textarea class="form-control" rows="5" v-model="exams.echocardiogram_note" maxlength="255" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></textarea>
                </div>
            </div>
            <div class="row form-group">
                <label for="" class="col-xs-6 col-sm-4">
                    Doppler de carótidas e vertebrais
                </label>
                <jv-yesno class="col-xs-12 col-sm-4" uid="exams_doppler_vertebral" :value="doppler_vertebral_status" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"
                            @select="cleanDopplerVertebral(doppler_vertebral_status)"></jv-yesno>
            </div>
            <div v-if="doppler_vertebral_status" class="form-group">
                <div class="form-group col-xs-12 col-sm-12">
                    <label class="col-xs-6 col-sm-6">Data</label>
                    <jv-date class="col-xs-6 col-sm-6" :value="exams.doppler_data_vertebral"
                             @update="exams.doppler_data_vertebral = arguments[0]"
                             :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                </div>
                <div class="col-xs-12">
                    <label>Observações</label>
                    <textarea class="form-control" rows="5" v-model="exams.doppler_vertebral_note" maxlength="255" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></textarea>
                </div>
            </div>          
            <div class="row form-group">
                <label for="" class="col-xs-6 col-sm-4">
                    Doppler transcraniano
                </label>
                <jv-yesno class="col-xs-12 col-sm-4" uid="exams_doppler_transcranial" :value="doppler_transcranial_status" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"
                            @select="cleanDopplerTranscranial(doppler_transcranial_status)"></jv-yesno>
            </div>
            <div  v-if="doppler_transcranial_status" class="form-group">
                <div class="form-group col-xs-12 col-sm-12">
                    <label class="col-xs-6 col-sm-6">Data</label>
                    <jv-date class="col-xs-6 col-sm-6" :value="exams.doppler_data_transcranial" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"
                             @update="exams.doppler_data_transcranial = arguments[0]"></jv-date>
                </div>
                <div  class=" form-group col-xs-12 col-sm-12">
                    <div class=" orm-group col-xs-12 ">
                        <label>Observações</label>
                        <textarea class="form-control" rows="5" v-model="exams.doppler_transcranial_note" maxlength="255" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></textarea>
                    </div>
                </div>
            </div>

            <div class="row form-group">
                <label for="" class="col-xs-6 col-sm-4">
                   RX de tórax
                </label>
                <jv-yesno class="col-xs-12 col-sm-4" uid="exams_xray" :value="xray_status" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"
                           @select="cleanXray(xray_status)"></jv-yesno>
            </div>
            <div v-if="xray_status" class="form-group col-xs-12 col-sm-12">
                <label class="col-xs-12 col-sm-8">
                    Área cardíaca
                </label>
                <jv-select class="col-xs-12 col-sm-4" :value="exams.cardiac_area"
                           @select="exams.cardiac_area = arguments[0]"
                           :options="options['exams.cardiac_area']"
                           :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
            </div>

        </div>
    </div>
</template>

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

<script type="application/ecmascript">
  import { mapState } from 'vuex'

  export default {
    data () {
      return {
        admission_pa_status: true,
        tomography_datetime_status: true,
        telemetry_holter_status: true,
        echocardiogram_transthoracic_yesno: true,
        echocardiogram_transesophageal_yesno: true,
        doppler_vertebral_status: true,
        doppler_transcranial_status: true,
        xray_status: true,
        isFirst: true,
      }
    },

    computed: {
      ...mapState({
        exams: state => state.followup.exams,
        options: state => state.options,
        user: state => state.user,
        followup: state => state.followup,
        group: state => state.group
      })
    },
    created(){
        for (var key in this.exams) {
            if (this.exams.hasOwnProperty(key)) {
                if(this.exams[key] != null && this.exams[key] != ""){
                    this.isFirst = false
                }
            }
        }
        
        if(this.isFirst){
            this.admission_pa_status = true
            this.tomography_datetime_status = true
            this.telemetry_holter_status = true
        }

        if(!this.isFirst){
            if (typeof  this.exams.admission_pa[0] == 'undefined' && typeof  this.exams.admission_pa[1] == 'undefined') {
            this.admission_pa_status = false
            }

            if(this.exams.tomography_datetime == null){
                this.tomography_datetime_status = false
            }

            if(this.exams.note_telemetry_holter == null ||  this.exams.note_telemetry_holter.length === 0 ){
                this.telemetry_holter_status = false
            }

            if(this.exams.echocardiogram_transthoracic == null && this.exams.echocardiogram_note == null){
                this.echocardiogram_transthoracic_yesno = false
            }

            if(this.exams.echocardiogram_transesophageal == null && this.exams.echocardiogram_note == null){
                this.echocardiogram_transesophageal_yesno = false
            }

            if(this.exams.doppler_data_vertebral == null && this.exams.doppler_vertebral_note == null){
                this.doppler_vertebral_status = false
            }

            if(this.exams.doppler_data_transcranial == null &&  this.exams.doppler_transcranial_note == null){
                this.doppler_transcranial_status = false
            }

            if(this.exams.cardiac_area == null){
                this.xray_status = false
            }
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
        updateTomography(){
            this.tomography_datetime_status = !this.tomography_datetime_status
            if(!this.tomography_datetime_status){
                this.exams.tomography_datetime = null
            }
        },
        checkNIH (value) {
            value = parseInt(value, 10)

            if (value < 0) {
            this.exams.nih = 0
            return
            }

            if (value > 42) {
            this.exams.nih = 42
            return
            }
            this.exams.nih = value
        },

        checkBarthel (value) {
            value = parseInt(value, 10)
            
            if (value < 0) {
            this.exams.barthel = 0
            return
            }

            if (value > 100) {
            this.exams.barthel = 100
            return
            }

            this.exams.barthel = isNaN(value) ? 0 : value
      },
      updateStatus (value) {
        this.admission_pa_status = value
        if (!this.admission_pa_status) {
          this.exams.admission_pa = [];
        }
      }, 
      echocardiogramDisableTransthoracic (value){
          if(!value){
            this.exams.echocardiogram_transthoracic = null
          }
        return !value
      },
      echocardiogramDisableTransesophageal (value){
          if(!value){
            this.exams.echocardiogram_transesophageal = null
          }
        return !value
      },
      cleanHolter(){
          this.exams.note_telemetry_holter = null
          return this.telemetry_holter_status = !this.telemetry_holter_status
      },
      cleanTransthoracic(){
          this.echocardiogram_transthoracic_yesno = !this.echocardiogram_transthoracic_yesno
          if(this.echocardiogram_transthoracic_yesno == false &&  this.echocardiogram_transesophageal_yesno == false){
              this.exams.echocardiogram_note = null
          }

          return this.echocardiogram_transthoracic_yesno
      },
      cleanTransesophageal(){
            this.echocardiogram_transesophageal_yesno = !this.echocardiogram_transesophageal_yesno
            if(this.echocardiogram_transthoracic_yesno == false &&  this.echocardiogram_transesophageal_yesno == false){
              this.exams.echocardiogram_note = null
            }
          
            return this.echocardiogram_transesophageal_yesno
      },
      cleanDopplerVertebral(){
        this.doppler_vertebral_status = !this.doppler_vertebral_status
        this.exams.doppler_data_vertebral = null 
        this.exams.doppler_vertebral_note = null

        return this.doppler_vertebral_status
      },
      cleanDopplerTranscranial(){
        this.doppler_transcranial_status = !this.doppler_transcranial_status
        this.exams.doppler_data_transcranial = null
        this.exams.doppler_transcranial_note = null

        return this.doppler_transcranial_status
      },
      cleanXray(){
        this.xray_status = !this.xray_status
        this.exams.cardiac_area = null

        return this.xray_status
      }

    }
  }
</script>