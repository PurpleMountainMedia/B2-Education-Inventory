<template lang="html">
  <div>
    <el-card class="mb-sm mt-sm">
      <span slot="header">{{ report.name }}</span>
      <object-information :object="report" />
      <a
        :href="report.links.url"
        :title="report.name">
        <el-button
          type="primary"
          plain
          size="mini"
          class="mt-sm">{{ __('View Report') }}</el-button>
      </a>
    </el-card>
  </div>
</template>

<script>
export default {
  name: 'ReportCard',

  components: {
    ObjectInformation: () => import(/* webpackChunkName: "object-information" */'components/ObjectInformation')
  },

  props: {
    report: {
      required: true,
      type: Object
    }
  }
}
</script>

<style lang="css">
</style>
