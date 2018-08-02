<template>
    <div class="panel panel-default">
        <div class="panel-heading">Evento AVC Atual</div>
        <div class="panel-body">
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    No AVC atual quando iniciaram os sintomas (data e hora)?
                </label>
                <jv-date class="col-xs-12 col-sm-4" :value="current_event.event_datetime"
                         type="datetime"
                         @update="current_event.event_datetime = arguments[0]"
                         :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    Em que data e hora o(a) Sr(a) pediu ajuda?
                </label>
                <jv-date class="col-xs-12 col-sm-4" :value="current_event.help_datetime"
                         type="datetime"
                         @update="current_event.help_datetime = arguments[0]"
                         :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">
                    Em que data e hora o(a) Sr(a) chegou a porta do hospital?
                </label>
                <jv-date class="col-xs-12 col-sm-4" :value="current_event.arrival_datetime"
                         type="datetime"
                         @update="current_event.arrival_datetime = arguments[0]"
                         :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
            </div>
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">Qual transporte o(a) Sr(a) utilizou para vir ao hospital?</label>
                <jv-select class="col-xs-12 col-sm-4" :value="current_event.transportation"
                           :options="options['current_event.transportation']"
                           @select="current_event.transportation = arguments[0]"
                           :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
            </div>
            <div class="row form-group">
                <div class="col-xs-12">
                    <label>Observações</label>
                    <textarea class="form-control" rows="5" v-model="current_event.note" maxlength="255" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></textarea>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import { mapState } from 'vuex'
  export default {
    computed: {
      current_event: {
        get() {
          return this.$store.state.followup.current_event
        },
        set(current_event) {
            current_event.arrival_datetime = moment(String(current_event.arrival_datetime)).format('DD/MM/YYYY hh:mm');
            current_event.event_datetime = moment(String(current_event.event_datetime)).format('DD/MM/YYYY hh:mm');
            current_event.help_datetime = moment(String(current_event.help_datetime)).format('DD/MM/YYYY hh:mm');
            this.$store.dispatch('setFollowup', _.merge(this.$store.state.followup, { current_event }))
        }
      },
      ...mapState({
        options: state => state.options,
        user: state => state.user,
        followup: state => state.followup,
        group: state => state.group
      })
    },
    methods: {
        verifyGroup(){
            if (this.group == "JOINVASC") {
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