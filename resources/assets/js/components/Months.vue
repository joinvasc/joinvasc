<template>
    <div>
        <div class="input-group">
            <input type="text" class="form-control" :value="value"
                   @input="update($event.target.value)" maxlength="3">
            <span class="input-group-addon">anos</span>
        </div>
    </div>
</template>

<script>
  export default {
    props: {
      value: { required: true }
    },

    methods: {
      update (value) {
        this.$emit('update', value)
      }
    }
  }
</script>

<style scoped></style>
