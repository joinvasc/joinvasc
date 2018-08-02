<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <p class="lead">{{ title }}</p>
            </div>

            <div class="col-sm-12">
                <slot></slot>
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: {
                required: true,
                type: String
            }
        }
    }
</script>