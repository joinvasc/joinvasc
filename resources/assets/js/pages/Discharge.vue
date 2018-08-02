<template>
    <div class="panel panel-default">
        <div class="panel-heading">Alta</div>
        <div class="panel-body">
            <div class="row form-group">
                <label class="col-xs-12 col-sm-8">Data da alta</label>
                <jv-date class="col-xs-12 col-sm-4" :value="discharge.date"
                         @update="discharge.date = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-date>
            </div>
            <!--
            <div class="row form-group">
                <label class="col-xs-12 col-sm-4">Biobanco</label>
                <div class="col-xs-6 col-sm-4">
                    <jv-yesno uid="tomography_datetime" :value="discharge.biobase_status" 
                    @select="updateFieldFromStatus(arguments[0], 'biobase')" :disabled="$verifyAccess(user, 'biobase')"></jv-yesno>
                </div>
                <div class="col-xs-6 col-sm-4">
                    <input type="text" class="form-control" v-model="discharge.biobase.code" :disabled="$verifyAccess(user, 'biobase')">
                </div>
            </div>
            -->
            <jv-section title="Classificação de AVC">

                <div class="row form-group">
                    <label class="col-xs-12 col-sm-8">Classificação</label>
                    <jv-select class="col-xs-12 col-sm-4" :value="discharge.avc_type"
                               :options="options['discharge.avc_type']"
                               @select="discharge.avc_type = arguments[0]"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>

                <template v-if="isAvcType('ait')">
                    <div class="row form-group">
                        <label for="" class="col-xs-12 col-sm-8">
                            <strong>AIT</strong>
                        </label>
                        <jv-select class="col-xs-12 col-sm-4" :value="discharge.avc_ait.value"
                                   :options="options['discharge.avc_ait']"
                                   @select="discharge.avc_ait.value = arguments[0]"
                                   :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                    </div>
                </template>

                <template v-if="isAvcType('avc-i-toast')">
                    <div class="row form-group">
                        <label for="" class="col-xs-12 col-sm-6">
                            <strong>AVC I TOAST</strong>
                        </label>
                        <jv-check-group gid="discharge-avc-itoast" class="col-xs-12 col-sm-6"
                                        :value="discharge.avc_itoast.type"
                                        :options="options['discharge.avc_itoast']" :create="true"
                                        @update="discharge.avc_itoast.type = arguments[0]"
                                        :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
                    </div>
                </template>

                <template v-if="isAvcType('avc-h')">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <label><strong>AVC H</strong></label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <label>Tipo</label>
                            <jv-radio-group gid="discharge-avc-h-type" :value="discharge.avc_h.type"
                                            :options="options['discharge.avc_h_type']"
                                            @update="discharge.avc_h.type = arguments[0]"
                                            :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-radio-group>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <label>Operado</label>
                            <jv-yesno uid="avc_h_surgery" :value="discharge.avc_h.surgery"
                                      @select="discharge.avc_h.surgery = arguments[0]"
                                      :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                        </div>
                        </div>
                </template>

                <template v-if="isAvcType('hsa')">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4">
                            <label>
                                <strong>AVC HSA</strong>
                            </label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <label class="col-xs-6 col-sm-6">Operado</label>
                        </div>
                        <div class="col-xs-6 col-sm-4">
                            <jv-yesno uid="avc_h_surgery" :value="discharge.avc_hsa.surgery"
                                      @select="discharge.avc_hsa.surgery = arguments[0]" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-yesno>
                        </div>
                    </div>
                </template>

                <!-- RANKING -->
                <br>
                <div class="row form-group">
                    <label for="" class="col-xs-12 col-sm-8">
                        RANKING
                    </label>
                    <jv-select class="col-xs-12 col-sm-4" :value="discharge.rankin"
                               :options="options['discharge.rankin']"
                               @select="discharge.rankin = arguments[0]"
                               :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-select>
                </div>

                <!-- BARTHEL -->
                <div class="row form-group">
                    <label for="" class="col-xs-12 col-sm-8">
                        BARTHEL
                    </label>
                    <div class="col-xs-12 col-sm-4">
                        <input type="text" class="form-control" v-mask="'###'"
                               :value="discharge.barthel" @input="validateBarthel" :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()">
                    </div>
                </div>

                <!-- U-AVC -->
                <div class="row">
                    <div class="col-xs-12">
                        <label>
                            Para o paciente internado no HMSJ: Foi para o U-AVC em:
                        </label>
                        <jv-check-group gid="hmsj_uavc" :options="options['discharge.hmsj_uavc']"
                                        :value="discharge.hmsj_uavc.description"
                                        @update="discharge.hmsj_uavc.description = arguments[0]"
                                        :disabled="action === 'update' && $verifyAccess(user) && !verifyGroup()"></jv-check-group>
                    </div>
                </div>

            </jv-section>
            <div v-if="isAvcType('avc-i-toast')">
                <jv-ccs></jv-ccs>
            </div>
        </div>
    </div>
</template>

<script>
  import { mapState } from 'vuex'
  export default {
    computed: {
      ...mapState({
        discharge: state => state.followup.discharge,
        options: state => state.options,
        user: state => state.user,
        group: state => state.group
      })
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
      isAvcType (type) {
        return this.discharge.avc_type && this.discharge.avc_type.includes(type)
      },

      validateBarthel (event) {
        let val = event.target.value
        if (!val) {
          this.discharge.barthel = null
          return
        }

        if (val < 0) {
          val = 0
        }

        if (val > 100) {
          val = 100
        }

        this.discharge.barthel = val
      },

        updateFieldFromStatus(value, field) {
            this.discharge.biobase_status = value
            if(value==true){
                this.discharge.biobase.code = this.discharge.biobase_seq
            }else{
                this.discharge.biobase.code = null
            }
            console.log(value);
      }
    }
  }
</script>