<template lang="html">
  <div :loading="loading">
    <data-table
      ref="dataTable"
      :url="roomsUrl"
      :request-params="{schoolId: schoolId, buildingId: buildingId}"
      :options="tableOptions"
      :request-includes="['rooms.extra']"
      :request-with="['building']"
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
            label: this.ucFirst(this.eiDefaults['building_name'])
          }
        ]
      }
    },

    roomsUrl () {
      return `rooms`
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
