<template>
    <div class="panel panel-default">
        <div class="panel-heading">Condições Socioeconômicas</div>
        <div class="panel-body">
            <!-- POSSE DE ITENS -->
            <jv-section title="Posse de itens">

                <jv-assets-number class="row form-group" :value="sec.assets.bathrooms"
                                  @update="sec.assets.bathrooms = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    Banheiros
                </jv-assets-number>
                <jv-assets-number class="row form-group" :value="sec.assets.domestic_servants"
                                  @update="sec.assets.domestic_servants = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    Empregados domésticos
                </jv-assets-number>
                <jv-assets-number class="row form-group" :value="sec.assets.automobiles"
                                  @update="sec.assets.automobiles = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    Carros
                </jv-assets-number>
                <jv-assets-number class="row form-group" :value="sec.assets.motorcycles"
                                  @update="sec.assets.motorcycles = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    Motocicletas
                </jv-assets-number>
                <jv-assets-number class="row form-group" :value="sec.assets.computers"
                                  @update="sec.assets.computers = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    Computadores
                </jv-assets-number>
                <jv-assets-number class="row form-group" :value="sec.assets.dishwashers"
                                  @update="sec.assets.dishwashers = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    Lava-louças
                </jv-assets-number>
                <jv-assets-number class="row form-group" :value="sec.assets.fridges"
                                  @update="sec.assets.fridges = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    Geladeiras
                </jv-assets-number>
                <jv-assets-number class="row form-group" :value="sec.assets.freezers"
                                  @update="sec.assets.freezers = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    Freezers
                </jv-assets-number>
                <jv-assets-number class="row form-group" :value="sec.assets.washing_machines"
                                  @update="sec.assets.washing_machines = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    Lava-roupas
                </jv-assets-number>
                <jv-assets-number class="row form-group" :value="sec.assets.dvds"
                                  @update="sec.assets.dvds = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    DVDs
                </jv-assets-number>
                <jv-assets-number class="row form-group" :value="sec.assets.microwaves"
                                  @update="sec.assets.microwaves = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    Microondas
                </jv-assets-number>
                <jv-assets-number class="row form-group" :value="sec.assets.clothes_dryers"
                                  @update="sec.assets.clothes_dryers = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    Secadoras de Roupas
                </jv-assets-number>
            </jv-section>

            <!-- ESCOLARIDADE -->
            <jv-section title="Escolaridade">
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-6">Escolaridade da pessoa de referência</label>
                    <jv-select class="col-xs-12 col-sm-6" :value="demographic.schooling.patient"
                               @update="demographic.schooling.patient = arguments[0]"
                               :options="options['demographic.schooling']" :disabled="true"></jv-select>
                </div>
            </jv-section>

            <!-- SERVIÇOS PÚBLICOS -->
            <jv-section title="Serviços públicos">
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-6">Água encanada</label>
                    <jv-yesno class="col-xs-12 col-sm-6" uid="piped_water" :value="sec.piped_water"
                              @select="sec.piped_water = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                </div>
                <div class="row form-group">
                    <label class="col-xs-12 col-sm-6">Rua pavimentada</label>
                    <jv-yesno class="col-xs-12 col-sm-6" uid="paved_street" :value="sec.paved_street"
                              @select="sec.paved_street = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                </div>
            </jv-section>

            <!-- CLASSES => RESULTADO -->
            <jv-section title="Classes / Pontos">
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-hover">
                            <thead>
                            <th>Classe</th>
                            <th>Pontos</th>
                            </thead>
                            <tbody>
                              <tr :class="{'bg-primary': isHighlighted(45, 100)}">
                                  <td id="classe-a">A</td>
                                  <td>45 - 100</td>
                              </tr>
                              <tr :class="{'bg-primary': isHighlighted(38, 44)}">
                                  <td id="classse-b">B1</td>
                                  <td>38 - 44</td>
                              </tr>
                              <tr :class="{'bg-primary': isHighlighted(29, 37)}">
                                  <td id="classe-b2">B2</td>
                                  <td>29 - 37</td>
                              </tr>
                              <tr :class="{'bg-primary': isHighlighted(23, 28)}">
                                  <td id="classe-c1">C1</td>
                                  <td>23 - 28</td>
                              </tr>
                              <tr :class="{'bg-primary': isHighlighted(17, 22)}">
                                  <td id="classe-c2">C2</td>
                                  <td>17 - 22</td>
                              </tr>
                              <tr :class="{'bg-primary': isHighlighted(0, 16)}">
                                  <td id="classe-d">D - E</td>
                                  <td>0 - 16</td>
                              </tr>
                            </tbody>
                            <tfoot>
                            <td><strong>Soma Total (Posse + Instrução + Serviços Públicos)</strong></td>
                            <td>{{ totalSum }}</td>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </jv-section>

            <!-- OBSERVAÇÕES -->
            <div class="row">
                <div class="col-xs-12">
                    <p>
                        <small>
                            Fonte: Associação Brasileira de Empresas de Pesquisa (ABEP) - <a href="http://www.abep.org">http://www.abep.org</a>
                        </small>
                    </p>

                    <p>
                        <small>
                            Documento: <a href="http://www.abep.org/Servicos/DownloadCodigoConduta.aspx?id=11&p=home">http://www.abep.org/Servicos/DownloadCodigoConduta.aspx?id=11&p=home</a>
                        </small>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import { mapState } from 'vuex'
  import _ from 'lodash'

  export default {
    computed: {
      ...mapState({
        demographic: state => state.followup.demographic,
        sec: state => state.followup.socioeconomic_conditions,
        options: state => state.options,
        user: state => state.user,
        followup: state => state.followup,
        group: state => state.group
      }),

      totalSum: function () {
        let sum = 0
        
        _.each(this.sec.assets, (v, k) => {
          if (v) {
            sum += this.score.assets[k][v]
          }
        })

        if (this.demographic.schooling && this.demographic.schooling.patient) {
          sum += this.score.schooling[this.demographic.schooling.patient.replace('demographic-schooling-', '')]
        }

        if (!this.sec.schooling) {
          this.sec.schooling = this.demographic.schooling.patient
        }

        if (this.sec.piped_water) {
          sum += this.score.piped_water
        }

        if (this.sec.paved_street) {
          sum += this.score.paved_street
        }

        return sum
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
      isHighlighted (min, max) {
        return (this.totalSum >= min && this.totalSum <= max)
      }
    },

    data () {
      return {
        score: {
          assets: {
            bathrooms: [0, 3, 7, 10, 14],
            domestic_servants: [0, 3, 7, 10, 13],
            automobiles: [0, 3, 5, 8, 11],
            motorcycles: [0, 1, 3, 3, 3],
            dishwashers: [0, 3, 6, 6, 6],
            computers: [0, 3, 6, 8, 11],
            fridges: [0, 2, 3, 5, 5],
            freezers: [0, 2, 4, 6, 6],
            washing_machines: [0, 2, 4, 6, 6],
            dvds: [0, 1, 3, 4, 6],
            microwaves: [0, 2, 4, 4, 4],
            clothes_dryers: [0, 2, 2, 2, 2],
          },
          schooling: {
            'desconhecido':0,
            'analfabeto-ate-3a-serie-fundamental': 0,
            '4a-serie-fundamental': 1,
            'fundamental-completo': 3,
            'analfabeto-ate-3a-serie-fundamental': 2,
            'medio-completo': 4,
            'superior-completo': 7
          },
          piped_water: 4,
          paved_street: 2,
        }
      }
    }
  }
</script>