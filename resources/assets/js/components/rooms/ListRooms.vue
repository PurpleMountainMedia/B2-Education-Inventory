<template lang="html">
  <div :loading="loading">
    <data-table
      ref="dataTable"
      :url="roomsUrl"
      :request-params="{schoolId: schoolId, buildingId: buildingId}"
      :options="tableOptions"
      :request-includes="['rooms.extra']"
      :request-with="['building']"
      :request-with-count="['items']"
      :filter-options="filterOptions"
      type-name="room"/>
  </div>
</template>

<script>
export default {
  name: 'ListRooms',

  components: {
    DataTable: () => import(/* webpackChunkName: "data-table" */'../DataTable')
  },

  props: {
    schoolId: {
      type: [Number, String],
      required: true
    },
    buildingId: {
      type: [String],
      required: false,
      default: () => { return null }
    }
  },

  data () {
    return {
      loading: false
    }
  },

  computed: {
    tableOptions () {
      return {
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
            prop: 'building.name',
            label: this.ucFirst(this.eiDefaults['building_name']),
            formatter: (row) => { return <a href={row.building.links.url}>{row.building.name}</a> }
          },
          {
            prop: 'items_count',
            label: this.__('Number of Items')
          }
        ]
      }
    },

    roomsUrl () {
      return `rooms`
    },

    filterOptions () {
      return [
        {
          name: this.__('ID'),
          value: 'id',
          type: 'string'
        },
        {
          name: this.__('Name'),
          value: 'name',
          type: 'string'
        },
        {
          name: this.__('Type'),
          value: 'type',
          type: 'string'
        },
        {
          name: this.__('Number of Items'),
          value: 'items_count',
          type: 'relational_count'
        }
      ]
    }
  },

  methods: {
    getData () {
      this.$refs.dataTable.getData()
    }
  }
}
</script>

<style lang="css">
</style>
