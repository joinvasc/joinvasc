<template>
    <div>
        <input ref="input" class="form-control" type="text" :value="value">
    </div>
</template>

<style scoped>
    .form-control {
        width: 100%;
    }
</style>

<script>
    import moment from 'moment'

    export default {
        props: {
            format: {default: 'dd/mm/yyyy'},
            value: {required: true}
        },

        mounted() {
            const options = {
                format: this.format
            }

            // Bind DatePicker plugin to the element
            const $input = $(this.$refs.input)

            $input.datepicker(options).on('changeDate', e => this.update(e.target.value))
        },

        methods: {
            update(value) {
                this.$emit('select', value)
            }
        }
    }
</script>