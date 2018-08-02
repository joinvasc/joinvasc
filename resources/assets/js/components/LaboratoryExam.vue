<template>
    <div class="row form-group">
        <label class="col-xs-12 col-sm-4">
            <slot></slot>
        </label>
        <div class="col-xs-6 col-sm-2">
            <jv-yesno :uid="exam" :value="status" @select="updateStatus(arguments[0])" :disabled="disabled"></jv-yesno>
        </div>
        <template v-if="!options && !inputDate">
            <div class="col-xs-5 col-sm-6">
                <input type="text" class="form-control" v-model="exams[exam]" :disabled="!status || disabled" :maxlength="maxlength">
            </div>
        </template>
        <template v-if="options && !inputDate">
            <jv-select class="col-xs-6 col-sm-6" :value="exams[exam]"
                       :options="options" :disabled="!status || disabled" :create="create" :placeholder="placeholder"
                       @select="exams[exam] = arguments[0]"></jv-select>
        </template>
        <template v-if="inputDate">
        <jv-date class="col-xs-6 col-sm-6" :value="exams[exam]" :disabled="!status || disabled"
                         @update="exams[exam] = arguments[0]"></jv-date>
        </template>
    </div>
</template>

<script type="application/ecmascript">
  export default {
    data () {
      return {
        status: false,        
      }
    },
  
    created () {
      if (this.exams[this.exam] == '' || this.exams[this.exam] == null ) {
        //this.status = false
        if(this.isFirst){
          this.status = true
        }else{
          this.status = false
        }
      }else{
         this.status = true
      }
    },
    props: {
      exam: {
        type: String,
        required: true
      },
      options: {
        default: null
      },
      create: {
        type: Boolean,
        default: false
      },
      placeholder: {
        default: null
      },
      inputDate:{
        default: false
      },
      isFirst:{
        default:false
      },
      maxlength:{
        default:255
      },
      disabled: {default: false}
    },

    computed: {
      exams: {
        get () {
          return this.$store.state.followup.exams
        },
        set (exams) {
          this.$store.dispatch('setFollowup', _.merge(this.$store.state.followup, { exams }))
        }
      }
    },

    methods: {
      updateStatus (value) {
        console.log(value)
        this.status = value
        if (!this.status) {
          this.exams[this.exam] = ''
        }
      }
    }
  }
</script>