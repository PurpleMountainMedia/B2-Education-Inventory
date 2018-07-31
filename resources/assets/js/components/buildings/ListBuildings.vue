<template lang="html">
  <div :loading="loading">
    <data-table :url="buildingsUrl"
                type-name="building"
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
        ],
        actionLinks: [
          {
            urlCallback: function (row) {
              return `/buildings/${row.id}/edit`
            },
            textCallback: function (row) {
              return `${this.__('Edit')} ${this.ucFirst(this.eiDefaults['building_name'])}`
            }.bind(this),
            icon: 'fal fa-edit'
          },
          {
            urlCallback: function (row) {
              return `/buildings/${row.id}/rooms`
            },
            textCallback: function (row) {
              return `${this.__('List')} ${this.ucFirst(this.eiDefaults['rooms_name'])}`
            }.bind(this),
            icon: 'fal fa-door-open'
          },
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
