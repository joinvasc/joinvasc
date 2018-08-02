<template>
    <div>
      <div class="row btns-dash">
          <button class="btnAddDashboard" onclick="location.href='followups/novo'"><div class="teste glyphicon glyphicon-plus"></div></button>
          <button class="btnAddDashboard" id="delete" @click="modalDeletePatient()" :disabled="curretRow.length < 1 || curretRow.length == 0 " ><div class="teste glyphicon glyphicon-trash"></div></button>
          <button class="btnAddDashboard" @click="viewPatient()" :disabled="curretRow.length > 1 || curretRow.length == 0 "><div class="teste glyphicon glyphicon-eye-open"></div></button>

      </div>
      <div class="row">
        <v-client-table id="table" :data="rows" :columns="columns" :options="options2" @row-click="onRowClick">


	<template slot="id_person" scope="props">
		<input type="checkbox" 
		class="" 
		:value="props.row.id_person" 
		v-model="markedRows">
	</template>
        </v-client-table>
      </div>
      <v-dialog/>
    </div>
</template>
<script type="application/ecmascript">
  import { mapState } from 'vuex' 
  import axios from 'axios'
  import {ClientTable, Event} from 'vue-tables-2';
  import daterangepicker from 'daterangepicker';
  import Vue from 'vue'
  import toasted from "../libs/vue-toasted";

  window.moment = require('moment');

  export default {
    computed: {
      ...mapState({
        followup: state => state.followup,
        action: state => state.action,
        options: state => state.options,
      }),
    },

    data() {
        return{
          isFiltering: false,
          endDate: null,
          followupsFilter: [],
          initialDate : null,
          columns: ['id_person','event', 'cpf', 'name', 'interview_date', 'status', 'discharge'],
            rows:[],
            options2: {
              filterByColumn: false,
              perPage:10,
              pagination: { chunk:10,dropdown:false },
              filterable:['name'],
              headings: {
                id_person: 'Selecionado',
                event: 'Evento',
                cpf: 'CPF',
                name: 'Nome',
                interview_date: 'Data da entrevista',
                status: 'Status',
                discharge: 'Alta',
              },  
            },
          result: [],
          delay: 100,
          clicks: 0,
          timer: null,
          curretRow: [],
          allMarked:false,
          markedRows:[],
        }
    },
    props:{

    },
    methods: {
      getAllPatients: function (){
        var self = this;
        axios.post('getAllPatientsDashboard', {
        })
        .then(function (response) {
          console.log(response.data)
          self.rows = response.data;
        })
        .catch(function (error) {

        });
      },
      onRowClick: function (row){
        if(window.exData != null && !row.event.ctrlKey && row.event.target.type != "checkbox") {
          this.clearSelectedRows();
        }
        window.exData.push(row);
        this.curretRow.push(row); 
        if(row.event.target.type == "checkbox"){
          row.event.target.parentElement.parentElement.className = "highlight"
        }else{
          row.event.target.parentElement.className = "highlight"
          this.markedRows.push(row.row.id_person)
        }

        this.clicks++ 
          if(this.clicks === 1) {
            var self = this
            this.timer = setTimeout(function() {

              self.clicks = 0
            }, this.delay);
          } else{
             clearTimeout(this.timer);  
             window.location = `/followups/${row.row.id_followup}`
             this.clicks = 0;
          }      
      },
      unmarkAll(a, b){
        console.log(a)
      },

      deletePatient(){
        var self = this;
        console.log(this.curretRow)
        axios.post('deletePatient', {
          patient: self.curretRow
        })
        .then(function (response) {
          self.getAllPatients()
          self.clearSelectedRows()
          self.$toasted.success('<h4 style="color: white;"><strong>Exclusão realizada com sucesso! </strong></h4><i class="fa fa-floppy-o"></i>',{duration: 3000, theme:'bubble'});
                            
        })
        .catch(function (error) {
        });
      },
      clearSelectedRows(){
        for (let x = 0; x < window.exData.length; x++) {
          window.exData[x].event.target.parentElement.className = ''
          window.exData[x].event.target.parentElement.parentElement.className = ''
        }
        window.exData = []
        this.markedRows =[]
        this.curretRow =[]
      },
      viewPatient(){
        window.location = `/followups/${this.curretRow[0].row.id_followup}`
      },
      modalDeletePatient() {;
        this.$modal.show('dialog', {
            title: 'Joinvasc',
            text: 'Deseja realmente excluir o paciente',
            buttons: [
            {
                title: 'Sim',
                handler: () =>  {this.deletePatient();this.$modal.hide('dialog')} 
            },
            {       
                title: 'Não'
            }
            ]
        })
      }
    },
    mounted(){
      this.getAllPatients();
      var self = this
      $(document).click(function(e) {
        if (!$('#table').is(e.target) && $('#table').has(e.target).length === 0 && !$('#delete').is(e.target) && $('#delete').has(e.target).length === 0){
          self.clearSelectedRows()
        }
          
      });
    }
  }
  window.exData = [];
</script>