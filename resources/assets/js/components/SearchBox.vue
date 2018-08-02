<template>
    <div>
        <div class="row">
              <div v-if="checkenable" class="check-filter col-xs-8 checkbox">
                <input type="checkbox"  @click="searchEnablePatients()" ><label>Exibir registros arquivados</label>
            </div>
        </div>
        <div class="row">
           <div class="col-xs-12">
                <input type="text" class="form-control input-lg " placeholder="Buscar Paciente / Prontuário" autofocus
                       v-model="value" @input="search">
            </div>
          
        </div>

        <div class="row">
            <div class="col-xs-12" v-if="value.length > 3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <template v-if="this.count === 0">NENHUM RESULTADO</template>
                        <template v-if="this.count === 1">{{ count }} RESULTADO</template>
                        <template v-if="this.count > 1">{{ count }} RESULTADOS</template>
                    </div>
                    <div class="panel-body">
                        <div class="row" v-if="!results.length">
                            <div class="col-xs-12 text-center">
                                <strong>Nenhum resultado encontrado.</strong>
                            </div>
                        </div>
                        <div class="row" v-if="results.length">
                            <div class="col-xs-3">
                                <strong>Prontuário</strong>
                            </div>
                            <div class="col-xs-5">
                                <strong>Paciente</strong>
                            </div>
                             <div class="col-xs-4">
                                <strong>Evento</strong>
                            </div>
                            <hr>
                        </div>
                        <div class="row" v-for="result in results">
                            <a :href="'/followups/' + result.id_followup">
                                <div class="col-xs-3">
                                    <p class="lead">{{ result.id }}</p>
                                </div>
                                <div class="col-xs-5">
                                    <p class="lead">{{ result.name }}</p>
                                </div>
                                <div class="col-xs-4">
                                    <p class="lead">{{ result.admission_date }}</p>
                                </div>
                            </a>
                            <hr>
                        </div>
                        <div class="row text-center" v-if="count > 20">
                            <span class="badge badge-primary">...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="application/ecmascript">
  import api from '../api'

  export default {
    data () {
      return {
        value: '',
        results: [],
        count: 0,
        checkEnableQuery: false
      }
    },
    props:{
        checkenable: false,
        
    },
    methods: {
        searchEnablePatients(){
            this.checkEnableQuery = !this.checkEnableQuery
            this.search()
        },
      search () {
        
        if (this.value.trim().length === 0) {
          this.results = []
        }

        if (this.value.trim().length > 3) {
            if(!this.checkEnableQuery){  
            api.get(`/search?q=${this.value}`).then(
                response => {
                    this.results = response.data.data
                    this.count = this.results.length
                    console.log(this.results)
                },
                    error => {
                    console.log(error)
                }
            )
          }else{
            api.get(`/searchNotEnabled?q=${this.value}`).then(
                response => {
                    this.results = response.data.data
                    this.count = this.results.length
                },
                    error => {
                    console.log(error)
                }
            )
          }
        }
      }
    }
  }
</script>

<style scoped>
.check-filter{
    margin-bottom: 20px;
    margin-left: 20px;
}

</style>