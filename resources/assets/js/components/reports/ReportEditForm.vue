<template lang="html">
  <div>
    <edit-form
      :data-url="`reports/${reportId}`"
      :index-url="indexUrl"
      :request-includes="['reports.extra', 'reports.timestamps', 'reports.content']"
      :request-with="['createdBy']"
      :title="(data) => { return data.name }"
      :tag="(data) => { return data.type }"
      :breadcrumbs="breadcrumbs">

      <div
        slot="aboveCard"
        slot-scope="slotProps"
        class="mb-sm">
        <el-button
          size="mini"
          plain
          type="info">{{ __('Print Report') }}</el-button>
      </div>

      <template
        slot="form"
        slot-scope="slotProps">
        <object-information
          :object="slotProps.data"
          class="mb-sm" />

        <el-form-item
          :rules="{required: true}"
          label="Name"
          class="short_input"
          prop="name">
          <el-input v-model="slotProps.data.name"/>
        </el-form-item>

      </template>

      <template
        slot="belowCard"
        slot-scope="slotProps">
        <report-data-table :report="slotProps.data"/>
      </template>
    </edit-form>
  </div>
</template>

<script>
export default {
  name: 'ReportEditForm',

  components: {
    EditForm: () => import(/* webpackChunkName: "edit-form" */'components/EditForm'),
    LayoutCenterPage: () => import(/* webpackChunkName: "layout-center-page" */'components/layout/LayoutCenterPage'),
    ObjectInformation: () => import(/* webpackChunkName: "object-information" */'components/ObjectInformation'),
    ReportDataTable: () => import(/* webpackChunkName: "report-data-table" */'components/reports/ReportDataTable')
  },

  props: {
    reportId: {
      type: String,
      required: true
    },
    indexUrl: {
      required: true,
      type: String
    },
    breadcrumbs: {
      required: false,
      type: Function,
      default: (data) => { return [] }
    }
  },

  data () {
    return {

    }
  },

  computed: {

  },

  watch: {

  },

  mounted () {

  },

  methods: {

  }
}
</script>

<style lang="css">
</style>
