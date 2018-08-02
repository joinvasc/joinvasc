<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-heading">Campo III: Demográfico</div>
            <div class="panel-body">
                <!-- CITY -->
                <template v-if="$verifyAccess(user,'demographic')">
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-6">
                        O Sr(a) mora em Joinville?
                    </label>
                    <jv-yesno class="col-xs-12 col-sm-4" uid="city_joinville" :value="demographic.city.joinville"
                              @select="demographic.city.joinville = arguments[0]" :disabled="$verifyAccess(user)"></jv-yesno>
                </div>

                <div v-if="demographic.city.joinville" class="row form-group">
                    <label class="col-xs-12 col-sm-6">
                        Há quanto tempo o Sr(a) mora nessa cidade?
                    </label>
                    <jv-select class="col-xs-6 col-sm-6" :value="demographic.city.time"
                               @select="demographic.city.time = arguments[0]"
                               :options="options['demographic.city_time']" :disabled="$verifyAccess(user)"></jv-select>
                </div>

                <hr>

                <!-- ADDRESS -->
                <div class="row col-xs-12">
                    <p class="lead">Endereço</p>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        <label>CEP</label>
                        <input type="text" class="form-control" v-model="demographic.address.cep" v-mask="'#####-###'" @blur="searchAddress('cep')" :disabled="$verifyAccess(user) && !verifyGroup()">
                    </div>
                    <div class="col-xs-9 col-sm-7">
                        <label>Endereço</label>
                        <input type="text" class="form-control" @blur="searchAddress('address')"
                               v-model="demographic.address.name" :disabled="$verifyAccess(user) && !verifyGroup()">
                    </div>
                    <div class="col-xs-3 col-sm-2">
                        <label>Nº</label>
                        <input type="text" class="form-control" v-model="demographic.address.number" @blur="searchAddress('number')" :disabled="$verifyAccess(user) && !verifyGroup()">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label>Bairro</label>
                        <input type="text" class="form-control" v-model="demographic.address.neighborhood" :disabled="$verifyAccess(user) && !verifyGroup()">
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label>Ponto de referência</label>
                        <input type="text" class="form-control" v-model="demographic.address.reference" :disabled="$verifyAccess(user) && !verifyGroup()">
                    </div>
                </div>

                <hr>

                <!-- CONTACT -->
                <div class="row">
                    <div class="col-xs-12">
                        <p class="lead">Contato</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        <label>Tel. Residencial</label>
                        <input type="text" class="form-control" v-model="demographic.contact.phone"
                               v-mask="'(##) ####-####'" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <label>Tel. Celular</label>
                        <input type="text" class="form-control" v-model="demographic.contact.mobile"
                               v-mask="'(##) #####-####'" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <label>Tel. Trabalho</label>
                        <input type="text" class="form-control" v-model="demographic.contact.office_phone"
                               v-mask="'(##) ####-####'" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <label>Contato Trabalho</label>
                        <input type="text" class="form-control" v-model.trim="demographic.contact.office_name" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <label>Observações</label>
                        <textarea rows="3" class="form-control" v-model.trim="demographic.contact.note" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></textarea>
                    </div>
                </div>

                </template>

                <hr>

                <!-- PATIENT INFO -->
                <div class="row">
                    <div class="col-xs-12">
                        <p class="lead">Informações do Paciente</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label>Idade</label>
                        <input type="text" class="form-control" disabled v-model="demographic.age">
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label>Raça</label>
                        <jv-select :value="demographic.race" @select="demographic.race = arguments[0]"
                                   :options="options['demographic.race']" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <label>Peso</label>
                        <input type="text" class="form-control" v-model.trim="demographic.weight" v-mask="'###'" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>Altura</label>
                        <input type="text" class="form-control" v-model.trim="demographic.height" v-mask="'###'" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>IMC</label>
                        <input type="text" class="form-control" disabled :value="demographic.imc">
                    </div>
                </div>

                <hr>

                <!-- SCHOOLING -->
                <div class="row">
                    <div class="col-xs-12">
                        <p class="lead">Escolaridade</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <label>Escolaridade</label>
                        <jv-select :value="demographic.schooling.patient"
                                   @select="demographic.schooling.patient = arguments[0]"
                                   :options="options['demographic.schooling']"
                                   :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>Escolaridade da Mãe</label>
                        <jv-select :value="demographic.schooling.mother"
                                   @select="demographic.schooling.mother = arguments[0]"
                                   :options="options['demographic.schooling']"
                                   :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <label>Escolaridade do Pai</label>
                        <jv-select :value="demographic.schooling.father"
                                   @select="demographic.schooling.father = arguments[0]"
                                   :options="options['demographic.schooling']"
                                   :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>
                </div>

                <hr>

                <!-- PROFESSION -->
                <div class="row">
                    <div class="col-xs-12">
                        <p class="lead">Profissão</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <label>Profissão atual</label>
                         <jv-radio-group gid="demographic-profession1" class="col-xs-12 col-sm-12"
                                    :search="true"
                                    :value="demographic.profession.current"
                                    :options="options['demographic.profession']"
                                    @update="demographic.profession.current = arguments[0]"
                                    :create="true"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group> 
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <label>Profissão do pai</label>
                        <jv-radio-group gid="demographic-profession2" class="col-xs-12 col-sm-12"
                                    :search="true"
                                    :value="demographic.profession.father"
                                    :options="options['demographic.profession']"
                                    @update="demographic.profession.father = arguments[0]"
                                    :create="true"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group> 
                    </div>
                </div>

                <hr>

                <!-- HEALTH -->
                <div class="row">
                    <div class="col-xs-12">
                        <p class="lead">Saúde</p>
                    </div>
                </div>

                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">
                        Quando o(a) sr(a) era criança, do nascimento até aos 16 anos, sua saúde era?
                    </label>
                    <jv-select class="col-xs-12 col-sm-4" :value="demographic.health.child_health"
                               @select="demographic.health.child_health = arguments[0]"
                               :options="options['demographic.child_health']"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>

                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">
                        Com que frequência o(a) Sr(a) vai ao posto de saúde?
                    </label>
                    <jv-radio-group gid="demographic-healthcare-attendance" class="col-xs-12 col-sm-4"
                                    :value="demographic.health.healthcare_attendance"
                                    @update="demographic.health.healthcare_attendance = arguments[0]" :create="true"
                                    :options="options['demographic.healthcare_attendance']"
                                    :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="application/ecmascript">
  import { mapState } from 'vuex'
  import axios from 'axios'

  export default {
    computed: {
      ...mapState({
        demographic: state => state.followup.demographic,
        patient: state => state.followup.patient,
        options: state => state.options,
        user: state => state.user,
        followup: state => state.followup,
        group: state => state.group
      })
    },

    watch: {
      'demographic.weight': function () {
        this.calculateImc()
      },
      'demographic.height': function () {
        this.calculateImc()
      } 
    },

    mounted () {
        if(this.patient.birth_date != null){
            var splitBirthDate = this.patient.birth_date.split("/")
            var splitAdmissionDate = this.patient.admission_date.split("/")
            this.calculateAge(splitBirthDate[2]+"-"+splitBirthDate[1]+"-"+splitBirthDate[0], splitAdmissionDate[2]+"-"+splitAdmissionDate[1]+"-"+splitAdmissionDate[0] )
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
        isLeapYear(year) {
            var d = new Date(year, 1, 28);
            d.setDate(d.getDate() + 1);
            return d.getMonth() == 1;
        },
        calculateAge (birthDate, admissionDate) {
            var d = new Date(birthDate), now = new Date(admissionDate);
            var years = now.getFullYear() - d.getFullYear();
            d.setFullYear(d.getFullYear() + years);
            if (d > now) {
                years--;
                d.setFullYear(d.getFullYear() - 1);
            }
            var days = (now.getTime() - d.getTime()) / (3600 * 24 * 1000);
            this.demographic.age = Math.floor(years + days / (this.isLeapYear(now.getFullYear()) ? 366 : 365));
        },
        calculateImc () {
            if (!this.demographic.weight || !this.demographic.height) {
            return null
            }

            const height = this.demographic.height / 100
            this.demographic.imc = (this.demographic.weight / (height * height)).toFixed(2)
        },

        searchAddress (search) {
            var address

            if(search == "number"){
                 if(this.demographic.address.number == null || this.demographic.address.number == ""){
                    return null
                }
                if(this.demographic.address.cep){
                    address = this.demographic.address.cep
                }
                if(this.demographic.address.name){
                    address = "SC/Joinville/"+this.demographic.address.name
                }
            }

            if(search == "cep"){
                address = this.demographic.address.cep
                this.demographic.address.number = null  
            }
            
            if(search == "address" && (this.demographic.address.number != null && this.demographic.address.number != "") &&  this.demographic.address.name != ""){
                 address = "SC/Joinville/"+this.demographic.address.name 
            }
            if(search == "address" && (this.demographic.address.number == null || this.demographic.address.number == "") &&  this.demographic.address.name != ""){
                 return null 
            }
            if(address == "" || address == null){
                return null
            }

            axios.get(`https://viacep.com.br/ws/${address}/json/`).then(
            response => {
                if (!response.data || response.data.erro) {                   
                    return null
                }

                if(this.demographic.address.number != null && this.demographic.address.number != ""){
                    for(var i = 0; i<response.data.length; i++){
                    var complementoSplit = response.data[i].complemento.split(" ")  
                        if(response.data[i].complemento == ""){           
                            this.$set(this.demographic.address, 'name', response.data[i].logradouro)
                                this.$set(this.demographic.address, 'cep', response.data[i].cep)
                                this.$set(this.demographic.address, 'neighborhood', response.data[i].bairro)
                                break
                       }

                       //num
                       if(!response.data[i].complemento.includes(" ")){           
                            if(this.demographic.address.number == parseInt(response.data[i].complemento)){
                                this.$set(this.demographic.address, 'name', response.data[i].logradouro)
                                    this.$set(this.demographic.address, 'cep', response.data[i].cep)
                                    this.$set(this.demographic.address, 'neighborhood', response.data[i].bairro)
                                    break
                            }
                            continue
                       }
                       
                       //até num/num
                       if(complementoSplit[0] == "até"){            
                            var comp = complementoSplit[1]
                            if(comp.includes("/")){
                                comp = complementoSplit[1].split("/")
                                comp = comp[1]
                            }
                            if(this.demographic.address.number <= parseInt(complementoSplit[1])){
                                    this.$set(this.demographic.address, 'name', response.data[i].logradouro)
                                    this.$set(this.demographic.address, 'cep', response.data[i].cep)
                                    this.$set(this.demographic.address, 'neighborhood', response.data[i].bairro)
                                    break;
                            }
                            continue
                       }

                        //de num/num a num/num
                        if(complementoSplit[1].includes("/") && complementoSplit[3].includes("/")){             
                            var complementoSplitFirst = complementoSplit[1].split("/")
                            var complementoSplitSecond = complementoSplit[3].split("/")
                            if(this.demographic.address.number >= parseInt(complementoSplitFirst[0]) && this.demographic.address.number <= parseInt(complementoSplitSecond[1])){
                                this.$set(this.demographic.address, 'name', response.data[i].logradouro)
                                this.$set(this.demographic.address, 'cep', response.data[i].cep)
                                this.$set(this.demographic.address, 'neighborhood', response.data[i].bairro)
                                break
                            }
                            continue
                        }

                        //de num/num ao fim
                       if(complementoSplit[3] == "fim"){           
                            var complementoSplitFirst = complementoSplit[1].split("/")
                            if(this.demographic.address.number >= parseInt(complementoSplitFirst[0])){
                                this.$set(this.demographic.address, 'name', response.data[i].logradouro)
                                this.$set(this.demographic.address, 'cep', response.data[i].cep)
                                this.$set(this.demographic.address, 'neighborhood', response.data[i].bairro)
                                break
                            }
                            continue
                       }

                        //de num a num - lado par
                        if(!complementoSplit[1].includes("/") && !complementoSplit[3].includes("/")){
                            if(complementoSplit[6] == "par" && this.demographic.address.number%2 == 0 ){
                                if(this.demographic.address.number >=  parseInt(complementoSplit[1]) && this.demographic.address.number <=  parseInt(complementoSplit[3])){
                                    this.$set(this.demographic.address, 'name', response.data[i].logradouro)
                                    this.$set(this.demographic.address, 'cep', response.data[i].cep)
                                    this.$set(this.demographic.address, 'neighborhood', response.data[i].bairro)
                                    break
                                }
                            }
                            if(complementoSplit[6] == "ímpar" && this.demographic.address.number%2 != 0 ){
                                if(this.demographic.address.number >=  parseInt(complementoSplit[1]) && this.demographic.address.number <=  parseInt(complementoSplit[3])){
                                    this.$set(this.demographic.address, 'name', response.data[i].logradouro)
                                    this.$set(this.demographic.address, 'cep', response.data[i].cep)
                                    this.$set(this.demographic.address, 'neighborhood', response.data[i].bairro)
                                    break
                                }
                            }
                            continue
                        }
                    }
                }else{               
                    this.$set(this.demographic.address, 'name', response.data.logradouro)
                    this.$set(this.demographic.address, 'cep', response.data.cep)
                    this.$set(this.demographic.address, 'neighborhood', response.data.bairro)
                }
            }
        )
      }
    }
  }
</script>