<template>
    <jv-section title="Causative Classification System for Ischemic Stroke">
        <div class="row form-group">
            <div class="col-xs-12">
                <a href="https://ccs.mgh.harvard.edu/main.php" target="_blank" class="btn btn-default btn-block">
                    Acesse o site!
                </a>
            </div>
        </div>

        <div class="row form-group">
            <label class="col-xs-12 col-sm-8">
                A. Aterosclerose de grandes artérias supra aórticas (L.A.A)
            </label>
            <jv-select class="col-xs-12 col-sm-4" :value="ccs.laa" :options="options['ccs.options']"
                       @select="ccs.laa = arguments[0]"></jv-select>
        </div>

        <div class="row form-group">
            <label class="col-xs-12 col-sm-8">
                B. Embolia cardio-aórtica
            </label>
            <jv-select class="col-xs-12 col-sm-4" :value="ccs.cae" :options="options['ccs.options']"
                       @select="ccs.cae = arguments[0]"></jv-select>
        </div>

        <div class="row form-group">
            <label class="col-xs-12 col-sm-8">
                C. Oclusão de pequenas artérias (S.A.O)
            </label>
            <jv-select class="col-xs-12 col-sm-4" :value="ccs.sao" :options="options['ccs.options']"
                       @select="ccs.sao = arguments[0]"></jv-select>
        </div>

        <div class="row form-group">
            <label class="col-xs-12 col-sm-8">
                D. Outras causas
            </label>
            <jv-select class="col-xs-12 col-sm-4" :value="ccs.other_causes" :options="options['ccs.options']"
                       @select="ccs.other_causes = arguments[0]"></jv-select>
        </div>

        <div class="row form-group">
            <label class="col-xs-12 col-sm-8">
                E. Causas indeterminadas
            </label>
            <jv-select class="col-xs-12 col-sm-4" :value="ccs.undefined_causes"
                       :options="options['ccs.undefined_causes']"
                       @select="ccs.undefined_causes = arguments[0]"></jv-select>
        </div>

    </jv-section>
</template>

<script>
  import { mapState } from 'vuex'

  export default {
    computed: {
      ...mapState({
        ccs: state => state.followup.ccs,
        options: state => state.options
      })
    }
  }
</script>