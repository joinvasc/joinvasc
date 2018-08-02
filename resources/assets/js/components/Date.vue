<template>
    <div>
        <input class="form-control" type="text" :id="id" v-mask="format"  :value="value"
               :disabled="disabled"
               @input="update($event.target.value)">
    </div>
</template>

<style scoped>
    .form-control {
        width: 100%;
    }
</style>

<script>
    const regex = {
        date: /^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)(?:0?2)\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{4})$/,
        datetime: /^(?:(?:31(-|\/)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(-|\/)(?:0?[1,3-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(-|\/)(?:0?2)\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(-|\/)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{4})\s-\s(?:0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])$/,
        time: /^(?:0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])$/
    }

    const formats = {
        date: 'dD/mM/y###',
        datetime: 'dD/mM/y### - ##:##',
        time: '##:##'
    }

    const tokens = {
        '#': {
            pattern: /\d/
        },
        'm': {
          pattern: /[0-1]/
        },
        'M': {
          pattern: /[0-9]/
        },
        'd': {
          pattern: /[0-3]/
        },
        'D': {
          pattern: /[0-9]/
        },
        'y': {
          pattern: /[1-2]/
        }
    }

    export default {
        props: {
            type: {default: 'date'},
            value: {required: true},
            disabled: {default: false},
            id: {default: "date_component"},
        },

        computed: {
            format: function () {
                return {
                    mask: formats[this.type],
                    tokens: tokens
                }
            },
            placeholder: function () {
                return this.format.replace(/#/g, '_')
            }
        },

        methods: {
            check(value) {
                if (value && regex[this.type].test(value)) {
                    alert('A data é inválida.')
                    this.update(null)
                }
            },

            update(value) {
                this.$emit('update', value)
            }
        }
    }
</script>