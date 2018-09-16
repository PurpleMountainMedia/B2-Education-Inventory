<template lang="html">
  <div class="mt">
    <data-table
      v-if="report.content"
      :data="report.content"
      :server="false"
      :options="tableOptions"
      type-name="report"/>
    <el-card v-else>
      <h1 class="text-center">{{ __('Sorry, No Data') }}</h1>
    </el-card>
  </div>
</template>

<script>
export default {
  name: 'ReportDataTable',

  components: {
    DataTable: () => import(/* webpackChunkName: "data-table" */'components/DataTable')
  },

  props: {
    report: {
      required: true,
      type: Object
    }
  },

  data () {
    return {

    }
  },

  computed: {
    tableOptions () {
      return {
        display: { search: true },
        columns: [
          {
            prop: 'name',
            label: this.__('Name')
          },
          {
            prop: 'description',
            label: this.__('Description')
          },
          {
            prop: 'serial',
            label: this.__('Serial')
          },
          {
            prop: 'room.name',
            label: this.ucFirst(this.eiDefaults['room_name'])
          },
          {
            prop: 'room.building.name',
            label: this.ucFirst(this.eiDefaults['building_name'])
          }
        ]
      }
    }
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
