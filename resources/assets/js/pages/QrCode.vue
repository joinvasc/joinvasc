<template>
<div class="row">
    <div class="row text-center search">
        <div class="row">
           <div class="col-xs-6 col-xs-offset-3">
                <input type="text" class="form-control input-lg " placeholder="Buscar Paciente / Prontuário" autofocus
                       v-model="value" @input="search" @click="cleanSearch()">
            </div> 
        </div>
        <div class="row">
            <div id="pacientsPanel" class="col-xs-6 col-xs-offset-3" v-if="value.length > 3 && notSelected">
                <div  class="panel panel-default">
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
                            <div class="col-xs-9">
                                <strong>Paciente</strong>
                            </div>
                            <hr>
                        </div>
                        <div class="row" v-for="result in results">
                            <a @click="selectPatient(result)">
                                <div class="col-xs-3">
                                    <p class="lead">{{ result.id }}</p>
                                </div>
                                <div class="col-xs-9">
                                    <p class="lead">{{ result.name }}</p>
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
    <div class="row text-center">
        <div class="div-barcode qrcode">
            <img id='barcode' src="https://api.qrserver.com/v1/create-qr-code/?data=HelloWorld&amp;size=300x300" alt="" title="Joinvasc QRCode" width="100" height="100" hidden/>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-md-4 col-md-offset-4">
		    <button type="submit" id="btn-qrcode" @click="generateBarCode()" class="btn btn-success btn-block">Gerar QRCode</button>
		</div>
    </div>
		
	</div>
</template>
<style>
.search{
    margin-bottom: 15px;
}

.qrcode{
    margin-bottom: 15px;
}
</style>

<script>
import api from '../api'
export default {
     data () {
        return {
            value: '',
            results: [],
            count: 0,
            checkEnableQuery: false,
            notSelected: true,
            currentPatient:[]
        }
     },
    methods:{
        generateBarCode() {
            var generateQrCode = this.currentPatient.id_followup
            var url = 'https://api.qrserver.com/v1/create-qr-code/?data=' + generateQrCode + '&amp;size=300x300'
            $('#barcode').attr('src', url)
            $('#barcode').removeAttr('hidden')
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
      },
      selectPatient(result){
        this.value = result.id+" - "+result.name
        this.notSelected = false
        this.currentPatient = result
      },
      cleanSearch(){
        if(!this.notSelected){
            this.notSelected = true
            this.value = ""  
            $('#barcode').attr('hidden', true)
        }
      }
    }
}
    
</script>
