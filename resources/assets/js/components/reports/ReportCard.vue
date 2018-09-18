<template lang="html">
  <div>
    <el-card class="mb-sm mt-sm">
      <span slot="header">{{ report.name }}</span>
      <object-information :object="report" />
      <div>
        <a
          :href="report.links.url"
          :title="report.name">
          <el-button
            type="primary"
            plain
            size="mini"
            class="mt-sm action_btn">{{ __('View Report') }}</el-button>
        </a>
        <print-button
          :url="report.links.print"
          :button="{ type: 'info', class: 'action_btn' }" />
      </div>
    </el-card>
  </div>
</template>

<script>
export default {
  name: 'ReportCard',

  components: {
    ObjectInformation: () => import(/* webpackChunkName: "object-information" */'components/ObjectInformation'),
    PrintButton: () => import(/* webpackChunkName: "print-button" */'components/PrintButton')
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
