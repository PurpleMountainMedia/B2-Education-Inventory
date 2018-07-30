<template lang="html">
  <div :loading="loading">
    <data-table :url="buildingsUrl"
                :request-params="{schoolId: schoolId}"
                :options="tableOptions"
                :request-includes="['buildings.extra']">

    </data-table>
  </div>
</template>

<script>
export default {
  name: 'ListBuildings',

  props: {
    schoolId: {
      type: [Number, String],
      required: true,
    }
  },

  components: {
    DataTable: () => import(/* webpackChunkName: "data-table" */'../DataTable'),
  },

  data () {
    return {
      loading: false,
      tableOptions: {
        columns: [
          {
            prop: 'name',
            label: this.__('Name')
          },
          {
            prop: 'type',
            label: this.__('Type')
          }
        ]
      }
    }
  },

  computed: {
    buildingsUrl () {
      return `buildings`
    }
  }
}
</script>

<style lang="css">
</style>
