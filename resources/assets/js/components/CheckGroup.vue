<template>
    <div>
      <div class="limit">
        <div v-for="opt in allOptions" class="checkbox">
            <input type="checkbox" :id="makeId(opt.value)" :checked="isChecked(opt)" :disabled="disabled"
                   @click="update(opt.value)">
            <label :for="makeId(opt.value)">{{ opt.label }}</label>
        </div>
      </div>
        <div class="input-group" v-if="create">
            <input ref="newItem" type="text" class="form-control" placeholder="Outros - digite um novo valor"
                   @keyup.enter="add()" maxlength="60">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-sm" @click="add()" :disabled="disabled">
                    Adicionar
                </button>
            </span>
        </div>
    </div>
</template>

<style scoped lang="sass" rel="stylesheet/scss">
    .input-group {
        input.form-control {
            height: 32px;
        }
    }

    .limit{
      overflow:auto; 
      max-height: 220px;
    }
</style>

<script>
  import _ from 'lodash'
  import slugify from '../libs/slugify'

  export default {
    data () {
      return {
        allOptions: []
      }
    },

    props: {
      gid: { required: true },
      value: { required: true },
      options: { required: true },
      create: { default: false, type: Boolean },
      disabled: {default: false}
    },

    mounted () {
      this.allOptions = this.options
    },

    methods: {
      isChecked (option) {  
        if(this.value){     
          for(var x=0; x < this.value.length; x++){
            if(this.value[x] == option.value || this.value[x] == this.gid+"-"+option.value.replace(new RegExp(' ', 'g'), '-').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "")){
              return true
            }
          }
        }
        return false

      },

      add() {
        const label = this.$refs.newItem.value
        const value = label

        if (value.length) {
          this.allOptions.push({ value, label, id: null })
          this.update(value)
          this.$refs.newItem.value = ''
        }
      },

      update(value) {
        const selected = _.clone(this.value || [])

        if (selected.indexOf(value) === -1 && selected.indexOf(this.gid+"-"+value.replace(" ", "-").toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "")) === -1)  {
          selected.push(value)
        } else {         
          selected.splice(selected.indexOf(value), 1)
        }

        this.$emit('update', selected)
      },

      makeId(id) {
        return `${this.gid}_${id}`
      }
    }
  }
</script>