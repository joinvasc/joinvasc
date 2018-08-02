<template>
    <div class="panel panel-default">
        <div class="panel-heading">EpiVasc</div>
        <div class="panel-body">
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">Histórico</label>
                    <jv-check-group gid="epivasc_history" class="col-xs-12 col-sm-4" :value="epivasc.clinical_history"
                                    :options="options['epivasc.history']"
                                    @update="epivasc.clinical_history = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">Crises</label>
                    <jv-check-group gid="epivasc_seizures" class="col-xs-12 col-sm-4" :value="epivasc.seizures"
                                    :options="options['epivasc.seizures']"
                                    @update="epivasc.seizures = arguments[0]"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
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
        epivasc: state => state.followup.epivasc,
        options: state => state.options,
        user: state => state.user,
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

<style scoped></style>