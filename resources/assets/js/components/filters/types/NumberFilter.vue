<template lang="html">
  <el-input-number v-model="internalValue" controls-position="right" ref="input"></el-input-number>
</template>

<script>
export default {
  name: 'NumberFilter',

  props: {
    value: {
      required: false,
      type: String,
      default: () => { return '' }
    },
    onValueUpdate: {
      type: Function,
      required: false,
      default: function () {
        return function (value) {}
      }
    }
  },

  data () {
    return {
      internalValue: 0
    }
  },

  watch: {
    internalValue (val) {
      this.onValueUpdate(val)
      this.$emit('value-update', val)
    }
  },

  mounted () {
    this.internalValue = this.value
    this.$refs.input.focus()
    this.onValueUpdate(this.internalValue)
    this.$emit('value-update', this.internalValue)
  }
}
</script>

<style lang="css">
</style>
