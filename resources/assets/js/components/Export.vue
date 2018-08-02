<template>
<div>
<div class="row">
        <div id="addExport" class="col-xs-6 col-md-2 addExport box">
            <div class="row">
                <h4 class="labelExport">Adicionar exportação</h4>
            </div>
            <div class="row checkExport hide-menu ">
                <div v-for="menu in menus" class="checkbox">
                    <input :id="'checkMenu_'+menus.indexOf(menu)" type="checkbox" @click="addMenuToProfile(menu)"><label>{{menu}}</label>
                </div>
            </div>
            <div class="row">
                <h4 class="labelExport">Nome</h4>
            </div>
            <div class="row text-center saveExport">
                <input class="form-control exportName" type="text" v-model="profileName"/>
            </div>
            <div class="row btnSaveExportDiv">
               <span class="input-group-btn btnSaveExport">
                    <button class="btn btn-primary btn-sm btnSaveExport" @click="saveProfile()" :disabled="isSaving">
                        Salvar
                    </button>
                </span>
            </div>
        </div>
        <div id="btnAddMobile" v-on:click="clearOptions()" class="btnAddMobile glyphicon glyphicon-plus"></div>
            <h4 class="text-center ">Central de exportação</h4>
        <div class="row ">
            <div class="col-xs-4 col-xs-offset-4 col-md-4 col-md-offset-4">
                <select @change="secury()" name="rel" class="form-control" id="sel-rel" >
                    <option id="none" value="" selected disabled>Selecione</option>
                    <option v-for="option in options" id="opt" :value="option.columns" >{{option.name}}</option>
                </select><br>
                <button disabled type="submit" id="btn-rel" class="btn btn-success btn-block" @click="getFile()" >Download</button>
            </div>
        </div>
    </div>
    <div  id="loading" class="loading" style="display:none;">
        <clip-loader :loading="loading" :color="color" :size="size"></clip-loader>
    </div>
</div>

</template>


<style>
    
.box {
	margin-top: .5em;
	padding: .8em;
	background: #fff;
  box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.16);
}

.addExport{
    width: 275px;
    height: 100%;
    margin-top: -20px;
    margin-left: -275px;
    left: 0;
    z-index: 100;
    position: fixed; 
    display: block;
    overflow: auto;
  
    -ms-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}

.labelExport{
  margin-left: 5%;
}

.checkExport{
 margin-left: 10%;
}

.saveExport{
  margin-top:15px;
  margin-bottom:15px;
}

.exportName{
  width: 80%;
  margin-left: 10%
}

.btnSaveExport{
  float:right;
  margin-right: 10%;
  
}

.btnSaveExportDiv{
 height: 80px;
}

.addExport.hide-menu {
  -ms-transform: translate3d(-275px,0,0);
  -moz-transform: translate3d(-275px,0,0);
  -webkit-transform: translate3d(-275px,0,0);
  -o-transform: translate3d(-275px,0,0);
  transform: translate3d(-275px,0,0);
  
  -ms-transition: all 0.3s;
  -moz-transition: all 0.3s;
  -webkit-transition: all 0.3s;
  -o-transition: all 0.3s;
  transition: all 0.3s;
  
}

.showMenu{
  -ms-transform: translate3d(275px,0,0);
  -moz-transform: translate3d(275px,0,0);
  -webkit-transform: translate3d(275px,0,0);
  -o-transform: translate3d(275px,0,0);
  transform: translate3d(275px,0,0);
}

.selectExport{
    width: 80%;
    height: 38px;
    padding: 7px 12px;
    margin-bottom: 15px;
    margin-right: 1%;
    font-size: 14px;
    line-height: 1.428571429;
    color: #555555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #e7e7e7;
    border-radius: 4px;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
}

.btnAddExportConfig{
  height: 38px;
  width: 18%;
}

.btnAddMobile{
 padding-top: 10px;
  width: 40px;
  height: 40px;
  box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.16);

  -ms-transition: all 0.3s;
  -moz-transition: all 0.3s;
  -webkit-transition: all 0.3s;
  -o-transition: all 0.3s;
  transition: all 0.3s;
}

.btnAddMobile.hide-btnMobile {
  
  -ms-transition: all 0.25s;
  -moz-transition: all 0.25s;
  -webkit-transition: all 0.25s;
  -o-transition: all 0.25s;
  transition: all 0.25s;
  
}

.showBtnMobile {
  -ms-transform: translate3d(275px,0,0);
  -moz-transform: translate3d(275px,0,0);
  -webkit-transform: translate3d(275px,0,0);
  -o-transform: translate3d(275px,0,0);
  transform: translate3d(275px,0,0);
  
  -ms-transition: all 0.3s;
  -moz-transition: all 0.3s;
  -webkit-transition: all 0.3s;
  -o-transition: all 0.3s;
  transition: all 0.3s;
  
}

.glyphicon.glyphicon-plus {
    font-size: 40px;
}

.glyphicon.glyphicon-plus:before {
    margin-left: 10px;
}

.glyphicon.glyphicon-plus{
    font-size: 20px;
}
</style>

<script>
import axios from 'axios'
import toasted from "../libs/vue-toasted";

export default {
    data () {
        return{
            menus: ['Ultimo Evento AVC', 
            'Evento AVC Atual', 
            'Exames', 
            'Demográfico', 
            'Origem do Paciente', 
            'Condições Socioeconômicas', 
            'Fatores de Risco', 
            'Alta', 
            'Biobase', 
            'Formulario de Alta', 
            'EpiVasc',
            'Formulario de Imagens',
            'Followup 30 Dias',
            'Followup 6 meses',
            'Followup 1 ano',
            'Followup 2 ano',
            'Followup 3 ano',
            'Followup 4 ano',
            'Followup 5 ano',
            'Óbito'
            ],
            selectedMenus:[],
            profileName: "",
            options: [],
            isSaving: false
        }
    },
    methods:{
        secury() {    
            if (document.getElementById("none").selected) {
                document.getElementById("btn-rel").disabled = true;
            } else {
                document.getElementById("btn-rel").disabled = false;
            }
        },
        addMenuToProfile(menu){
            if(!this.selectedMenus.includes(menu)){
            this.selectedMenus.push(menu)
          }else{
            var index = this.selectedMenus.indexOf(menu);
            this.selectedMenus.splice(index, 1)
          }
         
        },
        saveProfile(){
            this.isSaving = true
            var self = this
            var sameName = false

            for(var i =0; i <this.options.length; i++){
                if(this.options[i].name == this.profileName){
                    sameName = true;
                }
            }

            if(!sameName && this.profileName != "" && this.selectedMenus.length > 0){
                axios.post('saveProfile', {
                    selectedMenus : this.selectedMenus.toString(),
                    profileName : this.profileName,
                })
                .then(function (response) {
                    self.$toasted.success('<h4 style="color: white;"><strong>Criado com sucesso!</strong></h4><i class="fa fa-floppy-o"></i>',{duration: 3000, theme:'bubble'})
                    self.getAllOptions()
                    self.isSaving = false 
                    $("#btnAddMobile").click();
                })
                .catch(function (error) {
                });
            }else{
                if(sameName){
                    self.$toasted.error('<h4 style="color: white;"><strong>Nome ja existente </strong></h4><i class="fa fa-floppy-o"></i>',{duration: 3000, theme:'bubble'})
                }
                if(this.selectedMenus.length == 0){
                    self.$toasted.error('<h4 style="color: white;"><strong>É necessario adicionar campos para exportação </strong></h4><i class="fa fa-floppy-o"></i>',{duration: 3000, theme:'bubble'})
                }
                if(this.profileName == ""){
                    self.$toasted.error('<h4 style="color: white;"><strong>Nome requerido </strong></h4><i class="fa fa-floppy-o"></i>',{duration: 3000, theme:'bubble'})
                }
                this.isSaving = false 
            }
        },
        getAllOptions(){
            axios.get(`getAllExportOptions`).then(
                response => {
                    this.options = response.data
                }
            )
        },
        getFile(){
            var options = document.getElementById("sel-rel").value.split(",")
            document.getElementById("loading").style.display = "block";
            axios.post('getExportFile', {
                options : options,
            },{
                responseType: 'blob'
            })
            .then(function (response) {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', 'Export.xlsx');
                document.body.appendChild(link);
                link.click();
                document.getElementById("loading").style.display = "none";
            })
            .catch(function (error) {
                document.getElementById("loading").style.display = "none";
            }); 
        }, 
        clearOptions(){
            this.selectedMenus = []
            this.profileName = ""
        }
    },
    created(){
        this.getAllOptions()
    },
     mounted: function() {
         $(document).ready(function() {
            $("#btnAddMobile").click(function(){
                var pos = $(".addExport").position();
                var position = pos.left;

                if (position <= 0) {
                    $(".addExport").removeClass("hide-menu");
                    $(".btnAddMobile").removeClass("hide-btnMobile");
                    $(".addExport").addClass("showMenu");
                    $(".btnAddMobile").addClass("showBtnMobile");                 
                }else{
                    $(".addExport").removeClass("showMenu");
                    $(".btnAddMobile").removeClass("showBtnMobile");
                    $(".addExport").addClass("hide-menu");
                    $(".btnAddMobile").addClass("hide-btnMobile");
                }
                for (var i = 0; i < 20; i++) { 
                    $('#checkMenu_'+i).prop('checked', false);
                }               
            }); 
        });
     },
}


</script>
