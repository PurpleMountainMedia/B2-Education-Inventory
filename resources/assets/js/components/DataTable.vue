<template lang="html">
  <div v-loading="loading">
    <el-row align="middle">
      <el-col>
        <b2-errors :errors="errors" />
      </el-col>
    </el-row>
    <el-row align="middle">
      <el-col :sm="12">
        <el-input
          v-if="mergedOptions.display ? mergedOptions.display.search : false"
          :placeholder="__('Search')"
          v-model="search"
          :disabled="filters.length >= 1">
          <i
            slot="prefix"
            class="el-input__icon el-icon-search"/>
        </el-input>
      </el-col>
      <el-col :sm="12">
        <slot name="createButton">
          <el-button
            v-if="mergedOptions.display ? mergedOptions.display.new : false"
            class="create_btn"
            type="primary"
            plain>{{ __('Add New') }}</el-button>
        </slot>
        <el-button
          v-if="mergedOptions.display ? mergedOptions.display.refresh : false"
          class="refresh_btn"
          type="info"
          plain
          @click="getData"><i class="el-icon-refresh"/></el-button>
      </el-col>
    </el-row>

    <el-row v-if="mergedOptions.display ? mergedOptions.display.filters : false">
      <filters-list
        :filters="filters"
        :options="filterOptions" />
    </el-row>

    <el-table
      :data="tableData"
      class="mt-sm">
      <el-table-column
        v-for="(column, key) in mergedOptions.columns"
        :key="key"
        :prop="column.prop"
        :width="column.width"
        :formatter="column.formatter"
        :label="column.label"/>

      <el-table-column
        v-if="mergedOptions.display ? mergedOptions.display.actions : false"
        :label="__('Actions')">
        <template slot-scope="scope">
          <slot
            :row="scope.row"
            :delete="deleteData"
            name="actionButtons">
            <a
              v-for="(btn, btnKey) in mergedOptions.actionLinks"
              :key="btnKey"
              :href="btn.urlCallback(scope.row)">
              <el-button
                :size="btn.size ? btn.size : 'mini'"
                class="action_btn view_btn">{{ btn.textCallback(scope.row) }} <i
                  v-if="btn.icon"
                  :class="btn.icon"/>
              </el-button>
            </a>
            <el-button
              size="mini"
              type="danger"
              class="action_btn delete_btn"
              @click="deleteData(scope.row)">{{ __('Delete') }}
            </el-button>
          </slot>
        </template>
      </el-table-column>

      <div slot="empty">
        <h1>Sorry, No Data</h1>
      </div>
    </el-table>

    <el-row class="table_footer">
      <el-col>
        <el-pagination
          :page-sizes="perPages"
          :page-size="paginationMeta.perPage"
          :total="paginationMeta.total"
          layout="sizes, prev, pager, next"
          @size-change="handleSizeChange"
          @current-change="handlePageChange"/>
      </el-col>
    </el-row>

  </div>
</template>

<script>
import api from 'utils/api'
import url from 'utils/url'
import filters from 'utils/filters'
import vueUrlParameters from 'vue-url-parameters'
var findIndex = require('lodash.findindex')
var throttle = require('lodash.throttle')

export default {
  name: 'DataTable',

  components: {
    FiltersList: () => import(/* webpackChunkName: "filters-list" */'components/FiltersList'),
    B2Errors: () => import(/* webpackChunkName: "b2-errors" */'components/B2Errors')
  },

  mixins: [vueUrlParameters],

  props: {
    typeName: {
      type: String,
      required: true
    },
    options: {
      type: Object,
      required: false,
      default: () => { return {} }
    },
    requestWith: {
      type: [String, Array],
      required: false,
      default: () => { return [] }
    },
    requestWithCount: {
      type: [String, Array],
      required: false,
      default: () => { return [] }
    },
    requestIncludes: {
      type: [String, Array],
      required: false,
      default: () => { return [] }
    },
    requestParams: {
      type: [Object],
      required: false,
      default: () => { return {} }
    },
    url: {
      type: String,
      required: false,
      default: () => { return null }
    },
    deleteUrl: {
      type: String,
      required: false,
      default: () => { return null }
    },
    data: {
      type: Array,
      required: false,
      default: () => { return [] }
    },
    server: {
      type: Boolean,
      required: false,
      default: () => { return true }
    },
    filterOptions: {
      type: Array,
      required: false,
      default: () => {
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
          }
        ]
      }
    }
  },

  data () {
    return {
      loading: false,
      internalData: [],
      mergedOptions: {},
      urlFilters: {},
      defaultOptions: {
        columns: [
          {
            prop: 'id',
            label: this.__('ID')
          },
          {
            prop: 'name',
            label: this.__('Name')
          }
        ],
        actionLinks: [
          {
            urlCallback: function (row) {
              var links = row.links ? row.links : {}
              if (links.self) {
                return links.url
              }
              return '/'
            },
            textCallback: function () { return this.__('View') }.bind(this)
          }
        ],
        display: {
          filters: true,
          search: true,
          new: true,
          refresh: true,
          actions: true
        }
      },
      paginationMeta: {
        total: 0,
        perPage: 0,
        orderBy: 'id',
        ascending: 0,
        currentPage: 1
      },
      search: null,
      filters: [],
      errors: {}
    }
  },

  computed: {
    perPages () {
      var total = this.paginationMeta.total
      return (total <= 15) ? [15] : (total <= 30) ? [15, 30] : (total <= 100) ? [15, 30, 100] : [15, 30, 100, 250]
    },

    tableData () {
      if (this.server) {
        return this.internalData
      } else {
        return this.internalData.slice(0, this.paginationMeta.perPage)
      }
    }
  },

  watch: {
    search: function (value) {
      if (this.server && value) {
        this.getData()
      }

      this.urlFilters[`${this.typeName}_search`] = value
      window.location.hash = url.serialize(this.urlFilters)
    },

    filters: {
      handler: function (newValue) {
        var hasValues = false
        newValue.forEach((filter) => {
          if (filters.hasValue(filter)) {
            hasValues = true
          }
        })
        if (hasValues) {
          this.getData()
        }
      },
      deep: true
    }
  },

  mounted () {
    Object.assign(this.mergedOptions, this.defaultOptions, this.options)

    var filters = this.getFiltersFromUrl({})
    filters = url.unserialize(filters)

    this.search = filters[`${this.typeName}_search`]

    if (this.server) {
      this.getData()
    } else {
      this.internalData = this.data
      this.paginationMeta.total = this.internalData.length
      this.paginationMeta.perPage = 15
      this.paginationMeta.perPage = 15
    }
  },

  methods: {
    getData: throttle(function () {
      this.loading = true
      const params = Object.assign(this.requestParams, {
        with: this.requestWith,
        withCount: this.requestWithCount,
        include: this.requestIncludes,
        limit: this.paginationMeta.perPage,
        ascending: this.paginationMeta.ascending,
        orderBy: this.paginationMeta.orderBy,
        page: this.paginationMeta.currentPage,
        search: this.search,
        filters: this.filters
      })

      api.get({
        path: this.url,
        params: params
      })
        .then(data => {
          this.loading = false
          this.internalData = data.data
          this.paginationMeta = {
            total: data.meta.total,
            perPage: parseInt(data.meta.per_page),
            currentPage: data.meta.current_page
          }
          this.errors = {}
          this.listen()
        })
        .catch(errors => {
          this.loading = false
          this.errors = errors
        })
    }, 1000),

    deleteData (row) {
      api.delete({
        path: `${this.deleteUrl}/${row.id}`
      })
        .then((data) => {
          this.getData()
        })
    },

    listen () {
      if (typeof window.Echo !== 'undefined') {
        window.Echo.private(`items.1`)
          .listen('ItemUpdated', (e) => {
            console.log(e.item)

            var index = findIndex(this.internalData, ['id', e.item.id])

            this.$set(this.internalData, index, e.item)
          })
      }
    },

    /**
       * Handle a size change event on the table.
       *
       * @param Int perPage
       * @return void
       */
    handleSizeChange (perPage) {
      this.paginationMeta.perPage = perPage
      if (this.server) {
        this.getData()
      }
    },

    /**
       * Handle a page change event on the table.
       *
       * @param Int page
       * @return void
       */
    handlePageChange (page) {
      this.paginationMeta.currentPage = page
      if (this.server) {
        this.getData()
      }
    }
  }
}
</script>

<style lang="scss">
.create_btn, .refresh_btn {
  float: right;
}
.refresh_btn {
  margin-right: 10px;
}
</style>
