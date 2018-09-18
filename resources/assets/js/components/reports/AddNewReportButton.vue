<template lang="html">
  <add-new-modal
    :modal="{title: 'Add Report'}"
    :button="addNewButton"
    :on-update="handleUpdate"
    :form="form"
    :with-request="withRequest"
    data-url="reports"
    add-name="Report">
    <add-new-report-fields
      slot="form"
      slot-scope="slotProps"
      :hide-type="hideType"
      :form="slotProps.form"
      :form-errors="slotProps.formErrors"/>
  </add-new-modal>
</template>

<script>
export default {
  name: 'AddNewReportButton',

  components: {
    AddNewModal: () => import(/* webpackChunkName: "add-new-modal" */'components/AddNewModal'),
    AddNewReportFields: () => import(/* webpackChunkName: "add-new-report-fields" */'components/reports/AddNewReportFields')
  },

  props: {
    onUpdate: {
      type: Function,
      required: false,
      default: (data) => {}
    },
    query: {
      type: Object,
      required: false,
      default: () => { return {} }
    },
    buttonType: {
      type: String,
      required: false,
      default: () => { return null }
    },
    type: {
      type: String,
      required: false,
      default: () => { return null }
    }
  },

  data () {
    return {
      form: {
        type: 'items',
        repeatEvery: 7,
        repeatEveryUnit: 'Days'
      }
    }
  },

  computed: {
    addNewButton () {
      var button = {}
      switch (this.buttonType) {
        case 'lowProfile':
          button = { text: this.__('Generate Report'), plain: true, icon: null, type: 'info' }
          break
        default:
          button = { text: this.__('Add Report'), plain: true }
      }
      return button
    },

    withRequest () {
      return {
        reportQuery: this.query,
        schoolId: this.query.schoolId
      }
    },

    hideType () {
      if (this.type) {
        return true
      }
      return false
    }
  },

  watch: {

  },

  mounted () {

  },

  methods: {
    handleUpdate (data) {
      this.onUpdate(data)
    }
  }
}
</script>

<style lang="css">
</style>
