<template lang="html">
  <el-date-picker
    ref="input"
    v-model="internalValue"
    :format="eiDateFormat"
    :value-format="serverDateFormat"
    type="date"/>
</template>

<script>
export default {
  name: 'DateFilter',

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
      internalValue: ''
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
