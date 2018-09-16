<template lang="html">
  <div :loading="loading">
    <data-table
      ref="dataTable"
      :request-params="{schoolId: schoolId, roomId: roomId}"
      :options="tableOptions"
      :request-includes="['items.extra']"
      :request-with="['room.building']"
      url="items"
      type-name="item"/>
  </div>
</template>

<script>
export default {
  name: 'ListItems',

  components: {
    DataTable: () => import(/* webpackChunkName: "data-table" */'../DataTable')
  },

  props: {
    schoolId: {
      type: [Number, String],
      required: true
    },
    roomId: {
      type: [Number, String],
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
            prop: 'description',
            label: this.__('Description')
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

  methods: {
    getData () {
      this.$refs.dataTable.getData()
    }
  }
}
</script>

<style lang="css">
</style>
