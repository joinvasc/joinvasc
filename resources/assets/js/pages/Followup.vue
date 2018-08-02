<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Etapas</div>
                    <div class="panel-body">

                        <ul class="nav">
                            <li v-for="item in menuItems">
                                <router-link v-if="isFirst(item.route)" :to="{name: item.route}">
                                    {{ item.label }}
                                </router-link>
                            </li>

                            <li class="divider"></li>

                            <!--<li>-->
                            <!--<div class="progress">-->
                            <!--<div class="progress-bar" role="progressbar" :style="{width: progress + '%'}">-->
                            <!--<span class="sr-only">{{ progress }}% Completo</span>-->
                            <!--</div>-->
                            <!--</div>-->
                            <!--</li>-->

                            <!--<li class="divider"></li>-->

                            <li>
                                <button class="btn btn-primary btn-block" id="btsave" @click="save" :disabled="saving || !canSave">
                                    <template v-if="saving">
                                        <i class="fa fa-spin fa-circle-o-notch"></i>
                                        Salvando
                                    </template>
                                    <template v-else>
                                        <i class="fa fa-floppy-o"></i>
                                        Salvar
                                    </template>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<style scoped rel="stylesheet/scss">
.divider {
  height: 1px;
  width: 100%;
  background: #ddd;
}
</style>

<script type="application/ecmascript">
import { mapState, mapGetters } from "vuex";
import menu from "../libs/menu";
import toasted from "../libs/vue-toasted";
import _ from "lodash";
import axios from 'axios'

export default {
  data() {
    return {
      saving: false,
      menuItems: menu,
      wasDisabled: false
    };
  },

  computed: {
    ...mapGetters(["progress"]),

    ...mapState({
      followup: state => _.cloneDeep(_.omit(state.followup, ["patient"])),
      patient: state => state.followup.patient,
      action: state => state.action
    }),

    canSave: function() {
      return this.patient && this.patient.name && this.patient.cpf;
    }
  },

  created() {
    this.$store.dispatch('verifyDead',{when: this.followup.ambulatory_care.dead_in})
  },

  methods: {
    ValidationFields(){
        if(this.followup.patient.name == null){warning("Preencher campo Nome")}
        save();
    },
    warning(msg){
         this.$toasted.error(
            '<h4 style="color: white;"><strong>Ocorreu um erro!: ' +
              msg +
              ' </strong></h4><i class="fa fa-floppy-o"></i>',
            { duration: 5000, theme: "bubble" }
          );
    },
    save() {
        
    this.saving = true
      const followup = this.followup;
      const patient = this.patient;
  
      var self = this;
        axios.post('isEnable', {
            id : self.followup.id
        })
        .then(function (response) {
            self.wasDisabled = (response.data.disabled != 0 && response.data.disabled != null && response.data != null);
            console.log(self.wasDisabled)
            if(!self.wasDisabled || self.followup.disabled == 0){
                // Send a saving request
                self.saving = true;
                
                self.$store
                    .dispatch(`${self.action}Followup`, { followup, patient })
                    .then(response => {
                        self.saving = false
                        if(!followup.id){
                            self.$toasted.success('<h4 style="color: white;"><strong>Criado com sucesso! </strong></h4><i class="fa fa-floppy-o"></i>',{duration: 3000, theme:'bubble'});
                            window.location = `/followups/${response.id}`
                        }else{
                            self.$toasted.success('<h4 style="color: white;"><strong>Salvo com sucesso! </strong></h4><i class="fa fa-floppy-o"></i>',{duration: 5000, theme:'bubble'});
                        }
                    })
                    .catch(error => {
                    self.saving = false;
                    self.$toasted.error(
                        '<h4 style="color: white;"><strong>Ocorreu um erro!: ' +
                        error +
                        ' </strong></h4><i class="fa fa-floppy-o"></i>',
                        { duration: 5000, theme: "bubble" }
                    );
                    });
            }else{
                self.$toasted.error('<h4 style="color: white;"><strong> Registro arquivado </strong></h4><i class="fa fa-floppy-o"></i>',  { duration: 5000, theme: "bubble" } );
                window.location = `/followups/${self.followup.id}`
            }
        })
        .catch(function (error) {
        });
        this.saving = false
        $("#btsave").prop("disabled",false);
    },
    isFirst(route){
        if (this.followup.id == null) {
            let result = route == 'followup-patient-info'? true : false
            return result
        } else {
            return true
        }
    }
  },
  mounted :
      function() {
         $(document).ready(function() {
            $("#btsave").click(function(){
                $("#btsave").prop("disabled",true);
            });
         });
    }
}
</script>