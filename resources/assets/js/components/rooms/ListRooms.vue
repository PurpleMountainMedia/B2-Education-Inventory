<template lang="html">
  <div :loading="loading">
    <data-table :url="roomsUrl"
                type-name="room"
                :request-params="{schoolId: schoolId}"
                :options="tableOptions"
                :request-includes="['rooms.extra']"
                :request-with="['building']">

    </data-table>
  </div>
</template>

<script>
export default {
  name: 'ListRooms',

  props: {
    schoolId: {
      type: [Number, String],
      required: true,
    }
  },

  data () {
    return {
      loading: false,
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

  components: {
    DataTable: () => import(/* webpackChunkName: "data-table" */'../DataTable'),
  },
}
</script>

<style lang="css">
</style>
