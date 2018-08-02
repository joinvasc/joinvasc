<template>
    <div>
        <label class="col-xs-12 col-sm-6">
            <slot></slot>
        </label>
        <jv-select class="col-xs-12 col-sm-6" :value="value" :options="number_options"
                   @select="update" :disabled="disabled"></jv-select>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                number_options: [
                    { value: 0, label: '0' },
                    { value: 1, label: '1' },
                    { value: 2, label: '2' },
                    { value: 3, label: '3' },
                    { value: 4, label: '4 ou +' }
                ]
            }
        },

        props: {
            value: {
                required: true
            },
            disabled: {default: false}
        },

        methods: {
            update (value) {
                this.$emit('update', value)
            }
        }
    }
</script>