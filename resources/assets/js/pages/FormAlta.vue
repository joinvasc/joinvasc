<template>
    <div class="panel panel-default">
        <div class="panel-heading">Formulário pós alta</div>
        <div class="panel-body">
        	<div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Medicamentos para HAS
                </label>
                <jv-check-group gid="formalta_medhas" class="col-xs-12 col-sm-6" :value="formalta.medhas"
                                :options="options['formalta.medhas']"
                                @update="formalta.medhas = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Medicamentos para DM
                </label>
                <jv-check-group gid="formalta_meddm" class="col-xs-12 col-sm-6" :value="formalta.meddm"
                                :options="options['formalta.meddm']"
                                @update="formalta.meddm = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Medicamentos para Dislipidemia
                </label>
                <jv-check-group gid="formalta_meddis" class="col-xs-12 col-sm-6" :value="formalta.meddis"
                                :options="options['formalta.meddis']"
                                @update="formalta.meddis = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Medicamentos antitrombóticos
                </label>
                <jv-check-group gid="formalta_medanti" class="col-xs-12 col-sm-6" :value="formalta.medanti"
                                :options="options['formalta.medanti']"
                                @update="formalta.medanti = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Medicamentos anticoagulantes
                </label>
                <jv-check-group gid="formalta_medantico" class="col-xs-12 col-sm-6" :value="formalta.medantico"
                                :options="options['formalta.medantico']"
                                @update="formalta.medantico = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Medicamentos para epilepsia
                </label>
                <jv-check-group gid="formalta_medepilepsia" class="col-xs-12 col-sm-6" :value="formalta.medepilepsia"
                                :options="options['formalta.medepilepsia']"
                                @update="formalta.medepilepsia = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Encaminhamentos para reabilitação
                </label>
                <jv-check-group gid="formalta_enca" class="col-xs-12 col-sm-6" :value="formalta.enca"
                                :options="options['formalta.enca']"
                                @update="formalta.enca = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-6">
                    Encaminhamentos para seguimento
                </label>
                <jv-check-group gid="formalta_encseg" class="col-xs-12 col-sm-6" :value="formalta.encseg"
                                :options="options['formalta.encseg']"
                                @update="formalta.encseg = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
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
      formalta: state => state.followup.formalta,
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