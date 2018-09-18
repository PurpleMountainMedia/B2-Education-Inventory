<template lang="html">
  <el-col
    :span="span"
    :offset="first ? 4 : 0">
    <slot />
  </el-col>
</template>

<script>
export default {
  name: 'FormCol',

  props: {
    span: {
      type: Number,
      required: false,
      default: () => { return 18 }
    },
    first: {
      type: Boolean,
      required: false,
      default: () => { return true }
    }
  }
}
</script>

<style lang="css">
</style>
