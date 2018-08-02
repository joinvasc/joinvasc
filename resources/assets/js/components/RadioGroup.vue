<template>
    <div>
      <div v-if="search" class="search">
        <input type="text" class="searchTextInput" placeholder=" Pesquisar"  v-model="seachOption">
      </div>
      <div class="limit">
        <div v-for="opt in allOptions" class="radio" :key="opt.value" >
          <input type="radio" :id="makeId(opt.value)" :name="gid + '_group'" :checked="isChecked(opt)" :disabled="disabled"
                @click="update(opt.value);verifyCheck(makeId(opt.value), opt)">
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

    .search{
      margin-bottom: 5px;
    }

    .searchTextInput{
      width: 100%;
      padding-left: 10px;
      border-radius: 25px;
      border: 2px solid #e7e7e7;
      outline: none;
    }

    .limit::-webkit-scrollbar {
        margin-top: 15px;
        width: 5px;
    }

    .limit::-webkit-scrollbar-thumb {
        border-radius: 10px;
        background-color: #e7e7e7;
    }
</style>

<script>
  import _ from 'lodash'
  import slugify from '../libs/slugify'

  export default {
    data () {
      return {
        allOptions: [],
        seachOption: "",
        lastCheck: null
      }
    },
    watch: {
      'seachOption': function () {
        var self = this
        this.allOptions = this.alphabeticalOrder(this.options)
        this.allOptions = this.allOptions.filter(function (item) {
          var re = new RegExp(self.seachOption, 'i');
          return item.label.match(re)
        })
      }
    },

    props: {
      gid: { required: true },
      value: { required: true },
      options: { required: true },
      create: { default: false, type: Boolean },
      search: { default: false, type: Boolean },
      disabled: {default: false}
    },

    mounted () {
      this.allOptions = this.alphabeticalOrder(this.options)
    },

    methods: {
      alphabeticalOrder(options){
        options.sort(function(a, b){
            if(a.label < b.label) return -1;
            if(a.label > b.label) return 1;
            return 0;
        })
        return options
      },
      isChecked (option) {
        if(this.value){
          return (option.value === this.selected || this.value.indexOf(option.value) !== -1 ||  this.value.indexOf(option.value.replace(new RegExp(' ', 'g'), '-').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "")) !== -1)
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
        this.$emit('update', value)
      },

      makeId(id) {
        return `${this.gid}_${id}`
      },

      verifyCheck(id, value){
        if(this.lastCheck == id || this.isChecked(value)){
          $('#'+id).prop('checked', false);
          this.update(null)
          this.lastCheck = null
        }else{         
          this.lastCheck = id
        }
      }
    }
  }
</script>
