<template lang="html">
  <div :loading="loading">
    <data-table url="items"
                type-name="item"
                :request-params="{schoolId: schoolId}"
                :options="tableOptions"
                :request-includes="['items.extra']">

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
      tableOptions: {
        columns: [
          {
            prop: 'name',
            label: this.__('Name')
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
