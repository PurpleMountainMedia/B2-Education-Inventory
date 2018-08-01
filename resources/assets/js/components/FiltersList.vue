<template lang="html">
  <div class="mt-sm">
    <filter-component v-for="(filter, key) in filters"
                      :filter="filter"
                      :key="key"
                      :on-remove-filter="removeFilter"/>
    <el-popover placement="bottom"
                :title="__('Add Filter')"
                width="250"
                ref="addFilterWindow"
                trigger="click"
                popper-class="add_filter_window"
                v-on:after-enter="afterWindowEnters">
      <el-button slot="reference"
                 type="text"
                 :disabled="!canAddNew"
                 icon="el-icon-circle-plus el-icon-right">{{ __('Add Filter') }}
      </el-button>

      <p><small>{{ __('Filter By') }}</small></p>

      <el-input class="mb-sm" v-model="filterBySearch" size="mini" ref="searchInput" :placeholder="__('Search for attribute')"></el-input>

      <div class="filter_list">
        <el-button class="filter_list_btn"
                   @click="addFilter(option, 'addFilterWindow')"
                   v-for="(option, key) in filteredOptions"
                   :key="key">{{ option.name }}
        </el-button>
      </div>
    </el-popover>

  </div>
</template>

<script>
import filters from 'utils/filters'
export default {
  name: 'FiltersList',

  components: {
    FilterComponent: () => import(/* webpackChunkName: "filter-component" */'components/FilterComponent'),
  },

  props: {
    filters: {
      type: Array,
      required: false,
      default: () => { return [] }

    }
  },

  data () {
    return {
      // filters: [],
      options: [
        {
          name: "ID",
          value: "id",
          type: "string"
        },
        {
          name: "Name",
          value: "name",
          type: "string"
        },
        {
          name: "Type",
          value: "type",
          type: "string"
        },
        {
          name: "Created At",
          value: "created_at",
          type: "date"
        },
        {
          name: "Updated At",
          value: "updated_at",
          type: "date"
        },
        {
          name: "Number of Rooms",
          value: "room_count",
          type: "number"
        },
        {
          name: "Created By",
          value: "created_by",
          type: "user"
        },
      ],
      filterBySearch: ''
    }
  },

  computed: {
    canAddNew () {
      var can = true
      this.filters.forEach((filter) => {
        filters.hasValue(filter) ? '' : can = false;
      })
      return can
    },

    filteredOptions () {
      return this.filterBySearch ? this.options.filter(o => o.name.toUpperCase().includes(this.filterBySearch.toUpperCase())) : this.options
    }
  },

  methods: {
    afterWindowEnters () {
      this.filterBySearch = ''
      this.$refs.searchInput.focus()
    },

    addFilter (option, popoverRef) {
      this.filters.push({
        attribute: option.value,
        operator: '',
        _attributeName: option.name,
        _operatorName: '',
        value: '',
        type: option.type
      })

      this.$refs[popoverRef].doClose()
    },

    removeFilter (filter) {
      this.filters.splice(this.filters.indexOf(filter), 1)
    }
  }
}
</script>

<style lang="scss">
.filter_list_btn {
    display: block;
    width: 100%;
    float: left;
    position: relative;
    margin: 2px 0px!important;
}
.add_filter_window {
    max-height: 200px;
    overflow: scroll;
}
</style>
