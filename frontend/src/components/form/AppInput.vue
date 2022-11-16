<template>
  <div class="input-group mb-3">
    <input :type="type"
           :placeholder="placeholder"
           :value="value"
           :class="{'is-invalid': error}"
           class="form-control"
           @input="change"
    >
    <div class="input-group-append">
      <div class="input-group-text">
        <span :class="icon"></span>
      </div>
    </div>
    <span v-if="error" class="error invalid-feedback">{{ error }}</span>
  </div>
</template>

<script>
export default {
  name: "AppInput",
  props: ['type', 'placeholder', 'error', 'value', 'icon'],
  emits: ['input'],
  methods: {
    change(event) {
      this.$emit('input', event.target.value)
    }
  }
}
</script>

<style scoped>

</style>