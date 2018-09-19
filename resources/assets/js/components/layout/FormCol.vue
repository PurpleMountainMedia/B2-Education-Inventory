<template lang="html">
  <el-col
    :md="{ offset: first ? 4 : 0, span: span }">
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
