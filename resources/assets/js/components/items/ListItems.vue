<template lang="html">
  <div :loading="loading">
    <data-table
      ref="dataTable"
      :request-params="mergedRequestParams"
      :options="tableOptions"
      :request-includes="['items.extra']"
      :request-with="['room.building', 'itemCategory', 'make']"
      :url="tableUrl"
      report-type="items"
      type-name="item">
      <template slot="aboveTableRow">
        <el-button
          v-if="allowGrouped"
          :icon="grouped ? 'el-icon-remove' : 'el-icon-circle-plus'"
          type="text"
          @click="grouped = !grouped">{{ grouped ? __('Un-Group Items') : __('Group Items') }}
        </el-button>
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
    },
    requestParams: {
      required: false,
      type: Object,
      default: () => {
        return {}
      }
    },
    groupedUrl: {
      required: false,
      type: String,
      default: () => { return 'items/grouped' }
    },
    url: {
      required: false,
      type: String,
      default: () => { return 'items' }
    },
    groupedOptions: {
      required: false,
      type: Object,
      default: () => { return {} }
    },
    options: {
      required: false,
      type: Object,
      default: () => { return {} }
    },
    allowGrouped: {
      required: false,
      type: Boolean,
      default: () => { return true }
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
        var groupedOptions = {
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
        return {
          ...groupedOptions,
          ...this.groupedOptions
        }
      }
      var options = {
        columns: [
          {
            prop: 'name',
            label: this.__('Name')
          },
          {
            prop: 'make.name',
            label: this.__('Make')
          },
          {
            prop: 'description',
            label: this.__('Description')
          },
          {
            prop: 'category.name',
            label: this.__('Category')
          },
          {
            prop: 'serial_number',
            label: this.__('Serial')
          },
          {
            prop: 'purchase_price',
            label: this.__('Cost')
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
          },
          {
            prop: 'missing_at',
            label: this.__('Missing')
          },
          {
            prop: 'write_off',
            label: this.__('Write Off')
          }
        ]
      }
      return {
        ...options,
        ...this.options
      }
    },

    mergedRequestParams () {
      var params = {
        schoolId: this.schoolId,
        roomId: this.roomId
      }
      return {
        ...params,
        ...this.requestParams
      }
    },

    tableUrl () {
      if (this.grouped) {
        return this.groupedUrl
      }
      return this.url
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
