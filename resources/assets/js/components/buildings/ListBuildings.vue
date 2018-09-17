<template lang="html">
  <div :loading="loading">
    <data-table
      :url="buildingsUrl"
      :request-params="{schoolId: schoolId}"
      :options="tableOptions"
      :request-includes="['buildings.extra']"
      :request-with-count="['rooms']"
      :filter-options="filterOptions"
      type-name="building"/>
  </div>
</template>

<script>
export default {
  name: 'ListBuildings',

  components: {
    DataTable: () => import(/* webpackChunkName: "data-table" */'components/DataTable')
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
    },

    filterOptions () {
      return [
        {
          name: 'ID',
          value: 'id',
          type: 'string'
        },
        {
          name: 'Name',
          value: 'name',
          type: 'string'
        },
        {
          name: 'Type',
          value: 'type',
          type: 'string'
        },
        {
          name: 'Created At',
          value: 'created_at',
          type: 'date'
        },
        {
          name: 'Updated At',
          value: 'updated_at',
          type: 'date'
        },
        {
          name: 'Number of Rooms',
          value: 'rooms_count',
          type: 'relational_count'
        },
        {
          name: 'Created By',
          value: 'created_by',
          type: 'user'
        }
      ]
    }
  }
}
</script>

<style lang="css">
</style>
