<template>
    <div class="panel panel-default">
        <div class="panel-heading">Último Evento AVC</div>
        <div class="panel-body">
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    O Sr(a) já teve episódio de AVC ou ameaça de AVC(AIT) na vida?
                </label>
                <jv-select class="col-xs-12 col-sm-4" :value="first_event.previous"
                           @select="first_event.previous = arguments[0]"
                           :options="options['first_event.previous']"
                           :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
            </div>
            <template v-if="isThereAPreviousEvent">
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">Quantos?</label>
                    <jv-select class="col-xs-12 col-sm-4" :value="first_event.number_of_events"
                               @select="first_event.number_of_events = arguments[0]"
                               :options="options['first_event.number_of_events']"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">Quando ocorreu o último AVC?</label>
                    <jv-date class="col-xs-12 col-sm-4" :value="first_event.last_event_date"
                             @update="first_event.last_event_date = arguments[0]"
                             :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
                </div>

                <div class="row">
                    <div class="col-xs-6 form-group">
                        <label>O Sr.(a) fez reabilitação após a alta? (Fisioterapia Motora,
                            Fonoaudióloga, Terapia Ocupacional, psicologia).</label>
                        <jv-radio-group gid="first-event-rehab" :options="options['first_event.rehab']"
                                        :value="first_event.rehab"
                                        @update="first_event.rehab = arguments[0]"
                                        :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                    </div>
                    <div class="col-xs-6 form-group">
                        <h5 class="text-center">Eventos anteriores</h5>
                        <v-client-table :data="rows" :columns="columns" :options="options2">
                            <a slot="followup30"></a>
                        </v-client-table>
                    </div>
                </div>
                <div class="row form-group" v-if="first_event.rehab == null  || first_event.rehab != 'first-event-rehab-nao'">
                    <label class="col-xs-12 col-sm-8">Qual tipo de reabilitação?</label>
                    <jv-check-group gid="first-event-rehab-details" class="col-xs-12 col-sm-4" :value="first_event.rehab_details"
                               @update="first_event.rehab_details = arguments[0]"
                               :options="options['first_event.rehab_details']"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
                </div>
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">Qual hospital o Sr.(a) ficou internado(a)?</label>
                    <jv-radio-group gid="first_event_hospital" class="col-xs-12 col-sm-4" :value="first_event.hospital"
                                    :options="hospitals" :create="true"
                                    @update="first_event.hospital = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                </div>
                <div class="row form-group" v-if="first_event.hospital == 'hospitals-ambulatorial'">
                    <label class="col-xs-12 col-sm-8">Qual Especialidade?</label>
                    <jv-radio-group gid="first-event-hospital-especialities" class="col-xs-12 col-sm-4" :value="first_event.hospital_especialities"
                                    :options="options['first_event.hospital_especialities']" :create="true"
                                    @update="first_event.hospital_especialities = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                </div>
                <div v-if="isHospitalEqualsHmsj" class="row form-group form-inline">
                    <label class="col-xs-12 col-sm-8">Se internado no HMSJ, o Sr.(a) ficou internado(a) na
                        U-AVC?</label>
                    <jv-yesno class="col-xs-12 col-sm-4" uid="hmsj_uavc" :value="first_event.hmsj_uavc"
                              @select="first_event.hmsj_uavc = arguments[0]"
                              :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
  import { mapState } from 'vuex'
  import _ from 'lodash'
  import {ClientTable, Event} from 'vue-tables-2';
  import daterangepicker from 'daterangepicker';
  import axios from 'axios'
  

  export default {
    computed: {
      ...mapState({
        followup: state => state.followup,
        first_event: state => state.followup.first_event,
        options: state => state.options,
        user: state => state.user,
        group: state => state.group
      }),
        hospitals: function (state) {
            if (!this.options) return []

            return _.filter(this.options.hospitals, o => !o.value.includes('busca-ativa'))
        },

        isThereAPreviousEvent: function () {
            const p = this.first_event.previous

            return (p && (p.includes('avc') || p.includes('ait')))
        },

        isHospitalEqualsHmsj: function () {
            if(this.first_event.hospital == null){
                return this.first_event.hospital
            }else{
                return this.first_event.hospital.includes('h-m-s-j')
            }
        }
    },
    data() {
        return{
          columns: ['event', 'admission_date'],
            rows:[
            ],
            options2: {
              filterable: false,
             pagination: { dropdown:false },
             headings: {
                  event: 'Evento',
                  admission_date: 'Data',
                },
             sortIcon: {
                  is: 'fa-sort-amount-up',
                  base: 'fas',
                  up: 'fa-sort-up',
                  down: 'fa-sort-down'
                },
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
        getAllPatients: function (){
            var self = this;
                axios.post('getLastEvents', {
                    rg : self.followup.patient.rg
                })
                .then(function (response) {
                   self.rows = response.data;
                })
                .catch(function (error) {
                });

        },
    },
    created(){
        this.getAllPatients()
    }
    
}
</script>