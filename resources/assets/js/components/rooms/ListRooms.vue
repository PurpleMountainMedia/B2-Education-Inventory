<template lang="html">
  <div :loading="loading">
    <data-table :url="roomsUrl"
                type-name="room"
                :request-params="{schoolId: schoolId}"
                :options="tableOptions"
                :request-includes="['rooms.extra']">

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

  components: {
    DataTable: () => import(/* webpackChunkName: "data-table" */'../DataTable'),
  },

  computed: {
    roomsUrl () {
      return `rooms`
    }
  }
}
</script>

<style lang="css">
</style>
