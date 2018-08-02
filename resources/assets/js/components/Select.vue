<template>
    <div>
        <select ref="select" class="form-control" :value="value" :multiple="multiple" :disabled="disabled">
            <option v-for="opt in options" :value="opt.value">{{ opt.label }}</option>
        </select>
    </div>
</template>

<script type="application/ecmascript">
  export default {
    props: {
      value: { required: true },
      options: { required: true },
      multiple: { default: false, type: Boolean },
      disabled: { default: false, type: Boolean },
      create: { default: false, type: Boolean },
      placeholder: { default: null }
    },

    mounted () {
      const options = {
        tags: this.create,
        allowClear: false,
        placeholder: this.create ? 'Para adicionar um valor, digite no campo abaixo.' : this.placeholder,
        tokenSeparators: [','],
        closeOnSelect: !this.multiple
      }

      // Initiate Select2
      const $select = $(this.$refs.select)

      $select.val(this.value).select2(options).on('change', ev => {
        this.$emit('select', $(ev.target).select2('val'))
      })

      // Check whether it's a multiple select box and update its label accordingly
      $select.on('select2:select', this.updateLabel)
      $select.on('select2:unselect', this.updateLabel)
    },

    methods: {
      updateLabel (event) {
        const $target = $(event.target)
        if (this.multiple) {
          var uldiv = $target.siblings('span.select2').find('ul')
          var count = $target.select2('data').length


          if (count === 0) {
            uldiv.html('')
            return
          }

          const phrase = (count === 1) ? 'item selecionado' : 'itens selecionados'
          uldiv.html(`<li>${count} ${phrase}</li>`)
        }
      },

      makeId (id) {
        return `${this.rid}_${id}`
      }
    }
  }


</script>