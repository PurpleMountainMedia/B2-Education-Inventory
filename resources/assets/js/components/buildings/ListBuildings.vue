<template lang="html">
  <div :loading="loading">
    <data-table
      :url="buildingsUrl"
      :request-params="{schoolId: schoolId}"
      :options="tableOptions"
      :request-includes="['buildings.extra']"
      :request-with-count="['rooms']"
      type-name="building"/>
  </div>
</template>

<script>
export default {
  name: 'ListBuildings',

  components: {
    DataTable: () => import(/* webpackChunkName: "data-table" */'../DataTable')
  },

  props: {
    schoolId: {
      type: [Number, String],
      required: true
    }
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
          },
          {
            prop: 'rooms_count',
            label: this.__('Number of Rooms')
          }
        ]
      }
    }
  },

  computed: {
    buildingsUrl () {
      return `buildings`
    },

    buildingName () {
      return 'building'
    }
  }
}
</script>

<style lang="css">
</style>
