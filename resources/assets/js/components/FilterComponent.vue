<template lang="html">
  <el-popover placement="bottom"
              width="250"
              ref="createFilterWindow"
              trigger="click"
              popper-class="filter_list_window">
    <el-button slot="reference" class="filter_btn" :type="hasValue ? '' : 'danger'" plain>{{ filter._attributeName }} <small>{{ filter._operatorName }}</small> <strong>{{ filter.value }}</strong>
      <span @click="removeFilter" class="btn_close">
        <el-tooltip class="item" effect="dark" :content="__('Delete Filter')" placement="top-start">
          <i class="fal fa-times-circle"></i>
        </el-tooltip>
      </span>
    </el-button>

    <div class="filter_options_list">
      <div class="filter_options_list_item mt-sm" v-for="(option, key) in filterOptions" :key="key">
        <el-radio v-model="filter.operator" @change="() => { filter._operatorName = option._operatorName  }" :label="option.operator">{{ option._operatorName }}</el-radio>

        <template v-if="filter.operator === option.operator">
          <keep-alive>
            <component v-bind:is="ucFirst(option.type) + 'Filter'" :on-value-update="(val) => filter.value = val"></component>
          </keep-alive>
        </template>

      </div>
    </div>

    <div class="filter_options_done_btn_wrap">
      <el-button type="primary" @click="$refs['createFilterWindow'].doClose()" class="filter_options_done_btn mt-sm">{{ __('Done') }}</el-button>
    </div>
  </el-popover>
</template>

<script>
import filters from 'utils/filters'
export default {
  name: 'FilterComponent',

  props: {
    filter: {
      type: Object,
      required: true,
    },
    onRemoveFilter: {
      type: Function,
      required: false,
      default () {
        return function (filter) {}
      }
    }
  },

  components: {
    InputFilter: () => import(/* webpackChunkName: "input-filter" */'components/filters/types/InputFilter'),
    DateFilter: () => import(/* webpackChunkName: "date-filter" */'components/filters/types/DateFilter'),
    NumberFilter: () => import(/* webpackChunkName: "number-filter" */'components/filters/types/NumberFilter'),
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
        },
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
        },
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
        },
      ],
      userOptions: [
        {
          _operatorName: 'is',
          type: 'input'
        },
      ]
    }
  },

  mounted () {
    this.$refs['createFilterWindow'].doShow()
    this.filter._operatorName = this[this.filter.type + 'Options'][0]._operatorName
    this.filter.operator = this[this.filter.type + 'Options'][0].operator
  },

  computed: {
    filterOptions () {
      return this[this.filter.type + 'Options']
    },

    hasValue () {
      return filters.hasValue(this.filter)
    }
  },

  methods: {
    removeFilter () {
      this.onRemoveFilter(this.filter)
      this.$emit('remove-filter', this.filter)
    },
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
