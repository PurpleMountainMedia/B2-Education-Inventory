<template lang="html">
  <el-popover
    ref="createFilterWindow"
    placement="bottom"
    width="250"
    trigger="click"
    popper-class="filter_list_window">
    <el-button
      slot="reference"
      :type="hasValue ? '' : 'danger'"
      class="filter_btn"
      plain>{{ filter._attributeName }} <small>{{ filter._operatorName }}</small> <strong>{{ filter.value }}</strong>
      <span
        class="btn_close"
        @click="removeFilter">
        <el-tooltip
          :content="__('Delete Filter')"
          class="item"
          effect="dark"
          placement="top-start">
          <i class="fal fa-times-circle"/>
        </el-tooltip>
      </span>
    </el-button>

    <div class="filter_options_list">
      <div
        v-for="(option, key) in filterOptions"
        :key="key"
        class="filter_options_list_item mt-sm">
        <el-radio
          v-model="filter.operator"
          :label="option.operator"
          @change="() => { filter._operatorName = option._operatorName }">{{ option._operatorName }}</el-radio>

        <template v-if="filter.operator === option.operator">
          <component
            :value="filter.value"
            :is="ucFirst(option.type) + 'Filter'"
            :on-value-update="(val) => filter.value = val"/>
        </template>

      </div>
    </div>

    <div class="filter_options_done_btn_wrap">
      <el-button
        type="primary"
        class="filter_options_done_btn mt-sm"
        @click="$refs['createFilterWindow'].doClose()">{{ __('Done') }}</el-button>
    </div>
  </el-popover>
</template>

<script>
import filters from 'utils/filters'
export default {
  name: 'FilterComponent',

  components: {
    InputFilter: () => import(/* webpackChunkName: "input-filter" */'components/filters/types/InputFilter'),
    DateFilter: () => import(/* webpackChunkName: "date-filter" */'components/filters/types/DateFilter'),
    NumberFilter: () => import(/* webpackChunkName: "number-filter" */'components/filters/types/NumberFilter')
  },

  props: {
    filter: {
      type: Object,
      required: true
    },
    onRemoveFilter: {
      type: Function,
      required: false,
      default () {
        return function (filter) {}
      }
    }
  },

  data () {
    return {
      stringOptions: [
        {
          _operatorName: 'is',
          operator: 'equals',
          type: 'input'
        },
        {
          _operatorName: 'is not',
          operator: 'not_equals',
          type: 'input'
        },
        {
          _operatorName: 'starts with',
          operator: 'starts_with',
          type: 'input'
        },
        {
          _operatorName: 'ends with',
          operator: 'ends_with',
          type: 'input'
        },
        {
          _operatorName: 'contains',
          operator: 'includes',
          type: 'input'
        },
        {
          _operatorName: 'does not contain',
          operator: 'not_includes',
          type: 'input'
        }
      ],
      dateOptions: [
        {
          _operatorName: 'on',
          operator: 'equals',
          type: 'date'
        },
        {
          _operatorName: 'is not on',
          operator: 'not_equals',
          type: 'date'
        },
        {
          _operatorName: 'before',
          operator: 'less_than',
          type: 'date'
        },
        {
          _operatorName: 'after',
          operator: 'greater_than',
          type: 'date'
        }
      ],
      numberOptions: [
        {
          _operatorName: 'is',
          operator: 'equals',
          type: 'number'
        },
        {
          _operatorName: 'is not',
          operator: 'not_equals',
          type: 'number'
        },
        {
          _operatorName: 'greater than',
          operator: 'greater_than',
          type: 'number'
        },
        {
          _operatorName: 'less than',
          operator: 'less_than',
          type: 'number'
        }
      ],
      userOptions: [
        {
          _operatorName: 'is',
          type: 'input'
        }
      ]
    }
  },

  computed: {
    filterOptions () {
      return this[this.filterType + 'Options']
    },

    filterType () {
      return filters.filterType(this.filter)
    },

    hasValue () {
      return filters.hasValue(this.filter)
    }
  },

  mounted () {
    this.$refs['createFilterWindow'].doShow()
    this.filter._operatorName = this[this.filterType + 'Options'][0]._operatorName
    this.filter.operator = this[this.filterType + 'Options'][0].operator
  },

  methods: {
    removeFilter () {
      this.onRemoveFilter(this.filter)
      this.$emit('remove-filter', this.filter)
    }
  }
}
</script>

<style lang="scss">
.filter_list_window {
    padding: 10px 0px 40px 0px;
}
.filter_options_list {
    max-height: 180px;
    overflow: scroll;
    padding: 0 20px 0 20px;
}
span.btn_close {
    margin-left: 6px;
}
.filter_options_done_btn {
    display: block;
    width: 100%;
    border-radius: 0px 0px 3px 3px;
}
.filter_options_done_btn_wrap {
    position: absolute;
    bottom: 0px;
    width: 100%;
    left: 0;
}
</style>
