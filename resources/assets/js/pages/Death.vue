<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            Óbito
        </div>
        <div class="panel-body">
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    Data do óbito
                </label>
                <jv-date class="col-xs-12 col-sm-4" :value="death.date" @update="death.date = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <label>Local</label>
                    <jv-radio-group gid="death-place" :value="death.place" :options="options['death.place']"
                                    @update="death.place = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <label>Causa</label>
                    <jv-radio-group gid="death-cause" :value="death.cause" :options="options['death.cause']"
                                    @update="death.cause = arguments[0]" :create="true" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
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
        death: state => state.followup.death,
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
        }       
    }
  }
</script>