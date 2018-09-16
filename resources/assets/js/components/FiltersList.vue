<template lang="html">
  <div class="mt-sm">
    <filter-component
      v-for="(filter, key) in filters"
      v-if="filter"
      :filter="filter"
      :key="key"
      :on-remove-filter="removeFilter"/>
    <el-popover
      ref="addFilterWindow"
      :title="__('Add Filter')"
      placement="bottom"
      width="250"
      trigger="click"
      popper-class="add_filter_window"
      @after-enter="afterWindowEnters">
      <el-button
        slot="reference"
        :disabled="!canAddNew"
        type="text"
        icon="el-icon-circle-plus el-icon-right">{{ __('Add Filter') }}
      </el-button>

      <p><small>{{ __('Filter By') }}</small></p>

      <el-input
        ref="searchInput"
        v-model="filterBySearch"
        :placeholder="__('Search for attribute')"
        class="mb-sm"
        size="mini"/>

      <div class="filter_list">
        <el-button
          v-for="(option, key) in filteredOptions"
          :key="key"
          class="filter_list_btn"
          @click="addFilter(option, 'addFilterWindow')">{{ option.name }}
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
    FilterComponent: () => import(/* webpackChunkName: "filter-component" */'components/FilterComponent')
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
      options: [
        {
          name: 'ID',
          value: 'id',
          type: 'string'
        },
        {
          name: 'Name',
          value: 'name',
          type: 'string'
        },
        {
          name: 'Type',
          value: 'type',
          type: 'string'
        },
        {
          name: 'Created At',
          value: 'created_at',
          type: 'date'
        },
        {
          name: 'Updated At',
          value: 'updated_at',
          type: 'date'
        },
        {
          name: 'Number of Rooms',
          value: 'rooms_count',
          type: 'relational_count'
        },
        {
          name: 'Created By',
          value: 'created_by',
          type: 'user'
        }
      ],
      filterBySearch: ''
    }
  },

  computed: {
    canAddNew () {
      var can = true
      this.filters.forEach((filter) => {
        if (filters.hasValue(filter)) {
          can = false
        }
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
        type: option.type,
        serverFormat: option.type === 'date' ? 'd/m/Y' : '',
        clientFormat: option.type === 'date' ? 'dd/MM/yyyy' : ''
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
