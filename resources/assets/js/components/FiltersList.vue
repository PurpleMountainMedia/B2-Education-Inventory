<template lang="html">
  <div class="mt-sm">
    <filter-component v-for="(filter, key) in filters"
                      :filter="filter"
                      :key="key"
                      :on-remove-filter="removeFilter"/>
    <el-popover placement="bottom"
                :title="__('Add Filter')"
                width="200"
                ref="addFilterWindow"
                trigger="click">
      <el-button slot="reference"
                 type="text"
                 icon="el-icon-circle-plus">{{ __('Add Filter') }}
      </el-button>

      <p><small>{{ __('Filter By') }}</small></p>

      <el-button class="filter_list_btn"
                 @click="addFilter(option, 'addFilterWindow')"
                 v-for="(option, key) in options"
                 :key="key">{{ option.name }}
      </el-button>
    </el-popover>

  </div>
</template>

<script>
export default {
  name: 'FiltersList',

  components: {
    FilterComponent: () => import(/* webpackChunkName: "filter-component" */'components/FilterComponent'),
  },

  data () {
    return {
      filters: [],
      options: [
        {
          name: "ID"
        },
        {
          name: "Name"
        }
      ]
    }
  },

  methods: {
    addFilter (option, popoverRef) {
      this.filters.push({
        name: option.name,
        operator: 'is',
        value: '',
        type: 'string'
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
</style>
