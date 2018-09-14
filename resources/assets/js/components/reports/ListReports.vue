<template lang="html">
  <div>
    <layout-center-page>
      <add-new-modal data-url="reports"
                     add-name="Report"
                     :button="{text: 'Add Report', plain: true}"
                     :with-request="{schoolId: schoolId, include: requestIncludes}"
                     :on-update="(data) => { reports.push(data) }"/>

      <report-card v-for="(report, key) in reports" :key="key" :report="report"/>

      <el-row class="table_footer">
        <el-col>
          <el-pagination :page-sizes="[15]"
                         :page-size="paginationMeta.perPage"
                         layout="sizes, prev, pager, next"
                         :total="paginationMeta.total">
          </el-pagination>
        </el-col>
      </el-row>

    </layout-center-page>
  </div>
</template>

<script>
import api from 'utils/api'

export default {
  name: 'ListReports',

  props: {
    schoolId: {
      required: true,
      type: String,
    }
  },

  data () {
    return {
      reports: [],
      errors: {},
      requestIncludes: ['reports.timestamps'],
      paginationMeta: {
        total: 0,
        perPage: 0,
        orderBy: 'id',
        ascending: 0,
        currentPage: 1,
      },
    }
  },

  mounted () {
    this.getReports()
  },

  components: {
    ReportCard: () => import(/* webpackChunkName: "report-card" */'components/reports/ReportCard'),
    LayoutCenterPage: () => import(/* webpackChunkName: "layout-center-page" */'components/layout/LayoutCenterPage'),
    AddNewModal: () => import(/* webpackChunkName: "add-new-modal" */'components/AddNewModal'),
  },

  methods: {

    getReports () {
      this.loading = true
      this.errors = {}

      api.get({
        path: 'reports',
        params: {
          schoolId: this.schoolId,
          include: this.requestIncludes
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
