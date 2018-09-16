<template lang="html">
  <el-input-number
    ref="input"
    v-model="internalValue"
    controls-position="right"/>
</template>

<script>
export default {
  name: 'NumberFilter',

  props: {
    value: {
      required: false,
      type: [String, Number],
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
