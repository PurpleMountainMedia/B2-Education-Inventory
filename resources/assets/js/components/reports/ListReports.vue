<template lang="html">
  <div>
    <layout-center-page>
      <add-new-modal
        :modal="{title: 'Add Report'}"
        :button="{text: 'Add Report', plain: true}"
        :with-request="{schoolId: schoolId, include: requestIncludes, with: requestWith}"
        :on-update="(data) => { reports.push(data) }"
        data-url="reports"
        add-name="Report">
        <add-new-report-fields
          slot="form"
          slot-scope="slotProps"
          :form="slotProps.form"
          :form-errors="slotProps.formErrors"/>
      </add-new-modal>

      <report-card
        v-for="(report, key) in reports"
        :key="key"
        :report="report"/>

      <el-row
        v-if="reports.length > 0"
        class="table_footer">
        <el-col>
          <el-pagination
            :page-sizes="[15]"
            :page-size="paginationMeta.perPage"
            :total="paginationMeta.total"
            layout="sizes, prev, pager, next"/>
        </el-col>
      </el-row>

      <el-card
        v-else
        class="mt">
        <h1 class="text-center">{{ __('Sorry, No Data') }}</h1>
      </el-card>

    </layout-center-page>
  </div>
</template>

<script>
import api from 'utils/api'

export default {
  name: 'ListReports',

  components: {
    ReportCard: () => import(/* webpackChunkName: "report-card" */'components/reports/ReportCard'),
    LayoutCenterPage: () => import(/* webpackChunkName: "layout-center-page" */'components/layout/LayoutCenterPage'),
    AddNewModal: () => import(/* webpackChunkName: "add-new-modal" */'components/AddNewModal'),
    AddNewReportFields: () => import(/* webpackChunkName: "add-new-report-fields" */'components/reports/AddNewReportFields')
  },

  props: {
    schoolId: {
      required: true,
      type: String
    }
  },

  data () {
    return {
      reports: [],
      errors: {},
      requestIncludes: ['reports.timestamps'],
      requestWith: ['createdBy'],
      paginationMeta: {
        total: 0,
        perPage: 0,
        orderBy: 'id',
        ascending: 0,
        currentPage: 1
      }
    }
  },

  mounted () {
    this.getReports()
  },

  methods: {

    getReports () {
      this.loading = true
      this.errors = {}

      api.get({
        path: 'reports',
        params: {
          schoolId: this.schoolId,
          include: this.requestIncludes,
          with: this.requestWith
        }
      })
        .then((data) => {
          this.loading = false
          this.errors = {}
          this.reports = data.data
        })
        .catch((error) => {
          this.loading = false
          this.errors = error
        })
    }
  }
}
</script>

<style lang="css">
</style>
