<template lang="html">
  <div :loading="loading">
    <data-table url="items"
                type-name="item"
                :request-params="{schoolId: schoolId}"
                :options="tableOptions"
                :request-includes="['items.extra']"
                :request-with="['room.building']">

    </data-table>
  </div>
</template>

<script>
export default {
  name: 'ListItems',

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
          },
        ]
      }
    }
  },

  components: {
    DataTable: () => import(/* webpackChunkName: "data-table" */'../DataTable'),
  },
}
</script>

<style lang="css">
</style>
