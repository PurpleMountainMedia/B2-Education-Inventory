<template lang="html">
  <div>
    <el-card class="mb-sm mt-sm">
      <span slot="header">{{ report.name }}</span>
      <object-information :object="report" />
    </el-card>
  </div>
</template>

<script>
export default {
  name: 'ReportCard',

  props: {
    report: {
      required: true,
      type: Object,
    }
  },

  components: {
    ObjectInformation: () => import(/* webpackChunkName: "object-information" */'components/ObjectInformation'),
  }
}
</script>

<style lang="css">
</style>
