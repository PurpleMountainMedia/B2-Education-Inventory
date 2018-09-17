<template lang="html">
  <div :loading="loading">
    <data-table
      ref="dataTable"
      :request-params="{schoolId: schoolId, roomId: roomId}"
      :options="tableOptions"
      :request-includes="['items.extra']"
      :request-with="['room.building']"
      :url="tableUrl"
      type-name="item">
      <template slot="aboveTableRow">
        <el-checkbox v-model="grouped">{{ __('Grouped') }}</el-checkbox>
      </template>
      <template
        slot="actionButtons"
        slot-scope="scope">
        <template v-if="grouped">
          <a :href="scope.row.links ? scope.row.links.url : null">
            <el-button
              size="mini"
              class="action_btn view_btn">{{ __('View Group') }}
            </el-button>
          </a>
        </template>
        <template v-else>
          <a :href="scope.row.links ? scope.row.links.url : null">
            <el-button
              size="mini"
              class="action_btn view_btn">{{ __('View') }}
            </el-button>
          </a>
          <el-button
            size="mini"
            type="danger"
            class="action_btn delete_btn"
            @click="scope.delete(scope.row)">{{ __('Delete') }}
          </el-button>
        </template>
      </template>
    </data-table>
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
      loading: false,
      groupedItems: [],
      grouped: false
    }
  },

  computed: {
    tableOptions () {
      if (this.grouped) {
        return {
          columns: [
            {
              prop: 'name',
              label: this.__('Name')
            },
            {
              prop: 'item_count',
              label: this.__('Item Count')
            },
            {
              prop: 'room.name',
              label: this.ucFirst(this.eiDefaults['room_name']),
              formatter: (row) => { return <a href={row.room ? row.room.links.url : null}>{row.room ? row.room.name : null}</a> }
            },
            {
              prop: 'building.name',
              label: this.ucFirst(this.eiDefaults['building_name']),
              formatter: (row) => { return <a href={row.building ? row.building.links.url : null}>{row.building ? row.building.name : null}</a> }
            }
          ]
        }
      }
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
            label: this.ucFirst(this.eiDefaults['room_name']),
            formatter: (row) => { return <a href={row.room.links.url}>{row.room.name}</a> }
          },
          {
            prop: 'room.building.name',
            label: this.ucFirst(this.eiDefaults['building_name']),
            formatter: (row) => { return <a href={row.room.building ? row.room.building.links.url : null}>{row.room.building ? row.room.building.name : null}</a> }
          }
        ]
      }
    },

    tableUrl () {
      if (this.grouped) {
        return 'items/grouped'
      }
      return 'items'
    }
  },

  watch: {
    grouped () {
      this.$nextTick(() => {
        this.getData()
      })
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
