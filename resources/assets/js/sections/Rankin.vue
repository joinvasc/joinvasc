<template>
<div>
    <div class="col-xs-12 col-sm-12">
        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal" :disabled="disabled">
            <strong>Nivel: {{sum}}</strong>
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-body">
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-6">Obito do paciente</label>
                    <div class="col-xs-6 col-sm-3">
                        <span :class="labelClass(options.rankin_dead)">{{labelTitle(options.rankin_dead)}}</span>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <jv-yesno uid="rankin1" :value="options.rankin_dead" 
                        @select="options.rankin_dead = somar('options.rankin_dead', arguments[0])"></jv-yesno>
                    </div>
                </div>
                <div class="row form-group" v-if="options.rankin_dead == false">
                    <label class="col-xs-12 col-sm-6">Depois do AVC permaneceu alguma sequela? Possui alguma 
                        dificuldade para se movimentar, lembrar ou conversar com as pessoas?</label>
                    <div class="col-xs-6 col-sm-3">
                        <span :class="labelClass(options.rankin_sequel)">{{labelTitle(options.rankin_sequel)}}</span>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <jv-yesno uid="rankin2" :value="options.rankin_sequel" 
                        @select="options.rankin_sequel = somar('options.rankin_sequel', arguments[0])"></jv-yesno>
                    </div>
                </div>
                <div class="row form-group" v-if="options.rankin_dead == false && options.rankin_sequel == true">
                    <label class="col-xs-12 col-sm-6">Deixou de fazer alguma atividade que costumava realizar
                    antes do AVC? Isso inclui trabalhar, dirigir, usar transporte coletivo e lazer.</label>
                    <div class="col-xs-6 col-sm-3">
                        <span :class="labelClass(options.rankin_leave_activities)">{{labelTitle(options.rankin_leave_activities)}}</span>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <jv-yesno uid="rankin3" :value="options.rankin_leave_activities" 
                        @select="options.rankin_leave_activities = somar('options.rankin_leave_activities', arguments[0])"></jv-yesno>
                    </div>
                </div>

                <div class="row form-group" v-if="options.rankin_dead == false && 
                options.rankin_sequel == true && options.rankin_leave_activities == true">
                    <label class="col-xs-12 col-sm-6">Precisa da ajuda de outras pessoas para fazer alguma
                    atividade? Isso inclui fazer comida, compras, usar o banheiro, comer e se vestir..</label>
                    <div class="col-xs-6 col-sm-3">
                        <span :class="labelClass(options.rankin_need_help)">{{labelTitle(options.rankin_need_help)}}</span>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <jv-yesno uid="rankin4" :value="options.rankin_need_help" 
                        @select="options.rankin_need_help = somar('options.rankin_need_help', arguments[0])"></jv-yesno>
                    </div>
                </div>

                <div class="row form-group" v-if="options.rankin_dead == false && 
                options.rankin_sequel == true && options.rankin_leave_activities == true &&
                options.rankin_need_help == true">
                    <label class="col-xs-12 col-sm-6">Precisa de ajuda para andar de um cômodo a outro da casa?</label>
                    <div class="col-xs-6 col-sm-3">
                        <span :class="labelClass(options.rankin_need_help_walk)">{{labelTitle(options.rankin_need_help_walk)}}</span>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <jv-yesno uid="rankin5" :value="options.rankin_need_help_walk" 
                        @select="options.rankin_need_help_walk = somar('options.rankin_need_help_walk', arguments[0])"></jv-yesno>
                    </div>
                </div>

                <div class="row form-group" v-if="options.rankin_dead == false && 
                options.rankin_sequel == true && options.rankin_leave_activities == true &&
                options.rankin_need_help == true && options.rankin_need_help_walk == true">
                    <label class="col-xs-12 col-sm-6">Está acamado (não anda mesmo com a ajuda de outra
                    pessoa), incontinente e precisa de cuidados constantes?</label>
                    <div class="col-xs-6 col-sm-3">
                        <span :class="labelClass(options.rankin_bedridden)">{{labelTitle(options.rankin_bedridden)}}</span>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <jv-yesno uid="rankin6" :value="options.rankin_bedridden" 
                        @select="options.rankin_bedridden = somar('options.rankin_bedridden', arguments[0])"></jv-yesno>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
            <div class="row form-group">
                    <div class="col-xs-12 col-sm-12">
                        <div class="alert alert-info">
                        <strong>Valor: </strong>{{ sum }}
                        </div>
                    </div>
            </div>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <!-- <button type="button" class="btn btn-primary"></button> -->
            </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import { mapActions } from "vuex";
export default {
    data () {
      return {
        sum: 0,
        padrao: 0
      }
    },
    props: {
        value: {required: true},
        options: {required: true},
        time: {required:true},
        disabled: {default: false}
    },
    mounted () {
      this.sum = this.traslateLabel(this.value)
      this.padrao = this.traslateLabel(this.value)
    },
    methods:{
      ...mapActions([
          'verifyDead'
    ]),
        somar(id,argument){
            switch (id) {
                case 'options.rankin_dead':
                    if (argument == true) {
                        this.sum = 6
                        this.verifyDead({when: this.time})
                    } else {
                        this.sum = this.padrao == 6 ? 0 : this.padrao
                        //console.log(this.padrao)
                        this.verifyDead({when: null})
                    }
                    break;

                default:
                    if(argument == true) {
                        this.sum = this.sum + 1
                    } else if(this.sum > 0 && argument == false){
                        this.sum = this.sum - 1
                    } else{
                        this.sum = 0
                    }
                    break;
            }
            this.$emit('select', 'discharge-rankin-'+this.sum)
            return argument
        },
        traslateLabel(label){
            if (Number.isInteger(label)|| label == null) {
                return label
            } else {
                var res = label.split("discharge-rankin-");
                return parseInt(res[1])
            }
        },
        labelClass(value){
            var cls
            cls = value == true ? 'label label-success':'label label-danger'
            return cls
        },
        labelTitle(value){
            var cls
            cls = value == true ? 'Sim':'Não'
            return cls
        }
    }
}
</script>