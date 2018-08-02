<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">Origem do Paciente</div>
            <div class="panel-body">
                <div class="row form-group">
                    <div class="col-xs-12 col-sm-6">
                        Origem imediata do paciente
                    </div>
                    <jv-radio-group gid="patient-origin-immediate-origin" class="col-xs-6 col-sm-6"
                                    :value="patient_origin.immediate_origin"
                                    :options="options['patient_origin.immediate_origin']"
                                    @update="patient_origin.immediate_origin = arguments[0]"
                                    :create="true"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group> 
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import { mapState } from 'vuex'

  export default {
    computed: {
      ...mapState({
        patient_origin: state => state.followup.patient_origin,
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