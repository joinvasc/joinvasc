<template>
    <div>
        <div class="switch">
            <input type="checkbox" :id="uid" :checked="value" @change="update($event.target.checked)" :disabled="disabled">
            <label :for="uid" :class="type"></label>
        </div>
    </div>
</template>

<style scoped lang="sass">
    label.default {
        background-color: #2579a9;
    }

    .switch > input[type="checkbox"] {
        display: none;
    }

    .switch > label {
        cursor: pointer;
        height: 0px;
        position: relative;
        width: 40px;
    }

    .switch > label::before {
        background: rgb(0, 0, 0);
        box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
        border-radius: 8px;
        content: '';
        height: 16px;
        margin-top: -8px;
        position: absolute;
        opacity: 0.3;
        transition: all 0.4s ease-in-out;
        width: 40px;
    }

    .switch > label::after {
        background: rgb(255, 255, 255);
        border-radius: 16px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
        content: '';
        height: 24px;
        left: -4px;
        margin-top: -8px;
        position: absolute;
        top: -4px;
        transition: all 0.3s ease-in-out;
        width: 24px;
    }

    .switch > input[type="checkbox"]:checked + label::before {
        background: inherit;
        opacity: 0.5;
    }

    .switch > input[type="checkbox"]:checked + label::after {
        background: inherit;
        left: 20px;
    }
</style>

<script>
    export default {
        props: {
            uid: {required: true},
            value: {required: true},
            type: {
                type: String,
                default: 'default'
            },
            disabled: { default: false, type: Boolean },
        },

        methods: {
            update(value) {
                if(!this.disabled){
                    this.$emit('select', value)
                }
            },
        }
    }
</script>