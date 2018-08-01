<template lang="html">
  <div v-loading="loading">
    <el-row align="middle">
      <el-col :sm="12">
          <el-input :placeholder="__('Search')"
                    v-model="search">
                    <i slot="prefix" class="el-input__icon el-icon-search"></i>
          </el-input>
      </el-col>
      <el-col :sm="12">
        <slot name="createButton">
            <el-button class="create_btn" type="primary" plain>{{ __('Add New') }}</el-button>
        </slot>
        <el-button class="refresh_btn" @click="getData" type="info" plain><i class="el-icon-refresh"></i></el-button>
      </el-col>
    </el-row>

    <el-row>
      <filters-list />
    </el-row>

    <el-table :data="data" class="mt-sm">
      <el-table-column v-for="(column, key) in mergedOptions.columns"
                       :key="key"
                       :prop="column.prop"
                       :width="column.width"
                       :formatter="column.formatter"
                       :label="column.label">
      </el-table-column>

      <el-table-column :label="__('Actions')">
        <template slot-scope="scope">
          <slot name="actionButtons" :row="scope.row" :delete="deleteData">
            <a v-for="(btn, btnKey) in mergedOptions.actionLinks"
               :key="btnKey"
               :href="btn.urlCallback(scope.row)">
              <el-button :size="btn.size ? btn.size : 'mini'"
                         class="action_btn view_btn">{{ btn.textCallback(scope.row) }} <i v-if="btn.icon" :class="btn.icon"></i>
              </el-button>
            </a>
            <el-button size="mini"
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
  </div>
</template>

<script>
import api from 'utils/api'
import url from 'utils/url'
var findIndex = require('lodash.findindex');
var throttle = require('lodash.throttle');
import vueUrlParameters from 'vue-url-parameters'

export default {
    name: 'DataTable',

    mixins: [vueUrlParameters],

    components: {
      FiltersList: () => import(/* webpackChunkName: "filters-list" */'components/FiltersList'),
    },

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
        default: () => {}
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
        required: true,
      },
      deleteUrl: {
        type: String,
        required: false,
        default () { return this.url }
      }
    },

    data () {
      return {
        loading: false,
        data: [],
        mergedOptions: {},
        urlFilters: {},
        defaultOptions: {
          columns: [
            {
              prop: 'id',
              label: this.__('ID'),
            },
            {
              prop: 'name',
              label: this.__('Name')
            }
          ],
          actionLinks: [
            {
              urlCallback: function () {
                return '/'
              },
              textCallback: function () { return this.__('View') },
            }
          ]
        },
        paginationMeta: {
          total: 0,
          perPage: 0,
          orderBy: 'id',
          ascending: 0,
          currentPage: 1,
        },
        search: null,
      }
    },

    mounted () {
      Object.assign(this.mergedOptions,this.defaultOptions,this.options);

      var filters = this.getFiltersFromUrl({})
      filters = url.unserialize(filters)

      this.search = filters[`${this.typeName}_search`]

      this.getData();
    },

    watch: {
      search: function (value) {
        this.getData();

        this.urlFilters[`${this.typeName}_search`] = value
        window.location.hash = url.serialize(this.urlFilters)
      }
    },

    methods: {
      getData: throttle (function () {
        this.loading = true;
        const params = Object.assign(this.requestParams, {
            with: this.requestWith,
            include: this.requestIncludes,
            limit: this.paginationMeta.perPage,
            ascending: this.paginationMeta.ascending,
            orderBy: this.paginationMeta.orderBy,
            page: this.paginationMeta.currentPage,
            search: this.search
        });

        api.get({
          path: this.url,
          params: params
        })
        .then(data => {
          this.loading = false;
          this.data = data.data
          this.paginationMeta = {
            total: data.meta.total,
            perPage: parseInt(data.meta.per_page),
            currentPage: data.meta.current_page
          }
          this.listen()
        })
        .catch(errors => {
          this.loading = false;
        })
      }, 1000),

      deleteData (row) {
        api.delete({
          path: `${this.deleteUrl}/${row.id}`
        })
        .then((data) => {
          this.getData()
        })
        .catch((error) => {

        })
      },

      listen () {
        Echo.private(`items.1`)
            .listen('ItemUpdated', (e) => {
                console.log(e.item)

                var index = findIndex(this.data, ['id', e.item.id])

                this.$set(this.data, index, e.item)
            });
      },
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
