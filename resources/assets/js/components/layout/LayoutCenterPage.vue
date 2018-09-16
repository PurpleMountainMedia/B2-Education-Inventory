<template lang="html">
  <el-row
    justify="center"
    type="flex">
    <el-col
      :xl="12"
      :lg="16">
      <slot/>
    </el-col>
  </el-row>
</template>

<script>
export default {
  name: 'LayoutCenterPage'
}
</script>

<style lang="css">
</style>
