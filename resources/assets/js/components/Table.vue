<template>
<div class="row table-ambulatory">

  <div id="filter-panel" class="collapse filter-panel">
    <div id="panel" class="panel-body text-center  centered">
      <div class="col-xs-12 col-sm-5 col-md-4 filter filterComponent">
        <div class="row filter">
          <label class="filterLabel">Followups</label>
        </div>
        <div class="row" >
          <div class="text-center btn-group" data-toggle="buttons">
          <div class="btn btn-default button_season" @click="updateFollowupsFilter(100)">
              <input type="checkbox" name="followup_all" id="followup_all">Todos
            </div>
            <label class="btn btn-default button_season" @click="updateFollowupsFilter(1)">
                <input type="checkbox" name="followup_30" id="followup_30">30 Dias
            </label>
            <label class="btn btn-default button_season" @click="updateFollowupsFilter(6)">
                <input type="checkbox" name="followup_6" id="followup_6">6 Meses
            </label>
            <label class="btn btn-default button_season" @click="updateFollowupsFilter(12)">
              <input type="checkbox" name="followup_1" id="followup_1"  @click="updateFollowupsFilter()">1 Ano
            </label>
            </div>
        </div>
        <div class="row" >
          <div class="text-center btn-group filter" data-toggle="buttons">
              <label class="btn btn-default button_season2"  @click="updateFollowupsFilter(24)">
              <input type="checkbox" name="followup_2" id="followup_2">2 Anos
            </label>
            <label class="btn btn-default button_season2"  @click="updateFollowupsFilter(36)">
              <input type="checkbox" name="followup_3" id="followup_3">3 Anos
            </label>
            <label class="btn btn-default button_season2"  @click="updateFollowupsFilter(48)">
              <input type="checkbox" name="followup_4" id="followup_4">4 Anos
            </label>
            <label class="btn btn-default button_season2"  @click="updateFollowupsFilter(60)">
              <input type="checkbox" name="followup_5" id="followup_5">5 Anos
            </label>
        </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-5 filter filterComponent" >
          <div class="row filter"><label class="filterLabel">Vencimento da pendência</label></div>
            <div class="row filter ">
              <div class="col-xs-1 col-sm-2 col-md-2 col-xs-offset-3 col-sm-offset-0  "  style="">
              De
              </div>
              <jv-date class="col-xs-5 col-sm-10 col-md-10 " :id="'initialDate'"  :value="initialDate" v-model="initialDate"  type="date" ></jv-date>
            </div>
            
            <div class="row filter">
              <label class="col-xs-1 col-sm-2 col-md-2 col-xs-offset-3  col-sm-offset-0">
              à
              </label>
              <jv-date class="col-xs-5 col-sm-10  col-md-10" :id="'endDate'"  :value="endDate" v-model="endDate"  type="date" ></jv-date>
            </div>
      </div>
      <div class="col-xs-12 col-sm-3 col-md-3 text-center filter filterComponent" >
        <button type="button" class="btn btn-success" @click="getAllPatients(true)" >Consultar</button>
      </div>
    </div>
  </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">    
          <button type="button" class="filter_collapse " data-toggle="collapse" data-target="#filter-panel" @click="changeQuery()"> 
            <span> Filtros </span>
          </button>
        </div>
    
   
    <v-client-table :data="rows" :columns="columns" :options="options2">
      <a slot="followup30"  ></a>
    </v-client-table>
</div>
    
</template>

<style typy="text/css">


.centered {
  display: flex;
  align-items: center;
  justify-content: center;
}

.filterLabel{
  font-weight: bold;
}

.filter{
  padding-bottom: 15px;
}

.filterComponent{
  padding: 0px;
}

.followupLinkRealizado{
  color:#158CBA;
}
.followupLinkPendente{
  color:red;
}
.followupLinkAguardo{
  color:green;
}
.followupLinkAntecipado{
  color:blue;
}
table a:not(.btn), .table a:not(.btn) {
    text-decoration: none;
}

.filter_collapse {
    border-top: 25px solid gray;
    border-left: 50px solid white;
    border-right: 50px solid white;
    border-bottom: 0px solid white;
    height: 0;
    width: 150px;
}

.filter_collapse span
{
    position: relative;
    bottom: 25px;
    color: white
}

.panel-body{
  margin-bottom: 0px;

}

button:focus {
    outline: none;
}

.btn.active.active {
    outline: none;
}

.btn.active.focus {
    outline: none;
}

.btn.focus {
    outline: none;
}
btn-default:hover{
  background-color: #eeeeee;
    border-color: #e2e2e2;
}

.table-ambulatory .VueTables__search {
  display: none;
}

</style>


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
          columns: ['name', 'prontuario', 'followup30', 'followup3m', 'followup1a', 'followup2a', 'followup3a', 'followup4a', 'followup5a'],
            rows:[],
            options2: {
              templates: {
                  followup30: 'followup30',
                  followup3m: 'followup3m',
                  followup1a: 'followup1a',
                  followup2a: 'followup2a',
                  followup3a: 'followup3a',
                  followup4a: 'followup4a',
                  followup5a: 'followup5a'
              },
              filterByColumn: false,
              perPage:10,
              pagination: { chunk:10,dropdown:false },
              filterable:['name', 'prontuario'],
              headings: {
                  name: 'Nome',
                  prontuario: 'Prontuario',
                  followup30: '30 Dias',
                  followup3m: '3 meses',
                  followup1a: '1 ano',
                  followup2a: '2 anos',
                  followup3a: '3 anos',
                  followup4a: '4 anos',
                  followup5a: '5 anos'
                },  
            }
        }
    },
    props:{
      
    },
    methods: {
      getAllPatients: function (isFilter){

        var self = this;
        if( isFilter && (this.followupsFilter.length == 0 || document.getElementById('initialDate').value == "" || document.getElementById('endDate').value == "" )){
          this.$toasted.error(
            '<h4 style="color: white;"><strong>Filtro incompleto</strong></h4><i class="fa fa-floppy-o"></i>',
            { duration: 2000, theme: "bubble" }
          );
        }
        axios.post('getAllPatients', {
            followupsFilter : this.followupsFilter,
            initialDate : document.getElementById('initialDate').value,
            endDate : document.getElementById('endDate').value
        })
        .then(function (response) {
            self.rows = response.data;
        })
        .catch(function (error) {

        });
      },
      updateFollowupsFilter: function (value){
          if(!this.followupsFilter.includes(value)){
            this.followupsFilter.push(value)
          }else{
            var index = this.followupsFilter.indexOf(value);
            this.followupsFilter.splice(index, 1)
          }
      },
      changeQuery(){
        this.isFiltering = !this.isFiltering
        if(!this.isFiltering){
          this.getAllPatients(false)
        }
      }
    },
    mounted(){
      this.getAllPatients(false);
    }
  }

Vue.component('followup30', {
  props: ['name'],
  template: `<a :class='patientStyleClass()' :href="patientPath()" >{{patientStatus()}}</a>`,
  methods: {
      patientPath() {
          return('/followups/'+this.$attrs.data.personid+'#/followup30');
      },
      patientStyleClass(){
        switch (this.$attrs.data.followup30) {
          case "Realizado":
            return "followupLinkRealizado";
            break;
           case "Pendente":
            return "followupLinkPendente";
            break;
           case "Em Aguardo":
            return "followupLinkAguardo";
            break;
           case "Em Aguardo":
            return "followupLinkAntecipado";
            break;
        }
      },
      patientStatus(){
        return this.$attrs.data.followup30;
      }
    }
});

Vue.component('followup3m', {
  props: ['name'],
  template: `<a :class='patientStyleClass()' :href="patientPath()">{{patientStatus()}}</a>`,
  methods: {
      patientPath() {
          return('/followups/'+this.$attrs.data.personid+'#/followup3m');
      },
      patientStyleClass(){
        switch (this.$attrs.data.followup3m) {
          case "Realizado":
            return "followupLinkRealizado";
            break;
           case "Pendente":
            return "followupLinkPendente";
            break;
           case "Em Aguardo":
            return "followupLinkAguardo";
            break;
           case "Em Aguardo":
            return "followupLinkAntecipado";
            break;
        }
      },
      patientStatus(){
        return this.$attrs.data.followup3m;
      }
  }
});

Vue.component('followup1a', {
  props: ['name'],
  template: `<a :class='patientStyleClass()' :href="patientPath()">{{patientStatus()}}</a>`,
  methods: {
      patientPath() {
          return('/followups/'+this.$attrs.data.personid+'#/followup1a');
      },
      patientStyleClass(){
        switch (this.$attrs.data.followup1a) {
          case "Realizado":
            return "followupLinkRealizado";
            break;
           case "Pendente":
            return "followupLinkPendente";
            break;
           case "Em Aguardo":
            return "followupLinkAguardo";
            break;
           case "Em Aguardo":
            return "followupLinkAntecipado";
            break;
        }
      },
      patientStatus(){
        return this.$attrs.data.followup1a;
      }
  }
});

Vue.component('followup2a', {
  props: ['name'],
  template: `<a :class='patientStyleClass()' :href="patientPath()">{{patientStatus()}}</a>`,
  methods: {
      patientPath() {
          return('/followups/'+this.$attrs.data.personid+'#/followup2a');
      },
      patientStyleClass(){
        switch (this.$attrs.data.followup2a) {
          case "Realizado":
            return "followupLinkRealizado";
            break;
           case "Pendente":
            return "followupLinkPendente";
            break;
           case "Em Aguardo":
            return "followupLinkAguardo";
            break;
           case "Em Aguardo":
            return "followupLinkAntecipado";
            break;
        }
      },
      patientStatus(){
        return this.$attrs.data.followup2a;
      }
  }
});

Vue.component('followup3a', {
  props: ['name'],
  template: `<a :class='patientStyleClass()' :href="patientPath()">{{patientStatus()}}</a>`,
  methods: {
      patientPath() {
          return('/followups/'+this.$attrs.data.personid+'#/followup3a');
      },
      patientStyleClass(){
        switch (this.$attrs.data.followup3a) {
          case "Realizado":
            return "followupLinkRealizado";
            break;
           case "Pendente":
            return "followupLinkPendente";
            break;
           case "Em Aguardo":
            return "followupLinkAguardo";
            break;
           case "Em Aguardo":
            return "followupLinkAntecipado";
            break;
        }
      },
      patientStatus(){
        return this.$attrs.data.followup3a;
      }
  }
});

Vue.component('followup4a', {
  props: ['name'],
  template: `<a :class='patientStyleClass()' :href="patientPath()">{{patientStatus()}}</a>`,
  methods: {
      patientPath() {
          return('/followups/'+this.$attrs.data.personid+'#/followup4a');
      },
      patientStyleClass(){
        switch (this.$attrs.data.followup4a) {
          case "Realizado":
            return "followupLinkRealizado";
            break;
           case "Pendente":
            return "followupLinkPendente";
            break;
           case "Em Aguardo":
            return "followupLinkAguardo";
            break;
           case "Em Aguardo":
            return "followupLinkAntecipado";
            break;
        }
      },
      patientStatus(){
        return this.$attrs.data.followup4a;
      }
  }
});

Vue.component('followup5a', {
  props: ['name'],
  template: `<a :class='patientStyleClass()' :href="patientPath()">{{patientStatus()}}</a>`,
  methods: {
      patientPath() {
          return('/followups/'+this.$attrs.data.personid+'#/followup5a');
      },
      patientStyleClass(){
        switch (this.$attrs.data.followup5a) {
          case "Realizado":
            return "followupLinkRealizado";
            break;
           case "Pendente":
            return "followupLinkPendente";
            break;
           case "Em Aguardo":
            return "followupLinkAguardo";
            break;
           case "Em Aguardo":
            return "followupLinkAntecipado";
            break;
        }
      },
      patientStatus(){
        return this.$attrs.data.followup5a;
      }
  }
});

$(document).ready(function () {
    if($(window).width() > 767) {
      $("#panel").addClass("centered");
    }else{
      $("#panel").removeClass("centered");  
    }    
});
</script>

