<template lang="html">
  <el-popover placement="bottom"
              width="200"
              ref="createFilterWindow"
              trigger="click"
              popper-class="filter_list_window">
    <el-button slot="reference" class="filter_btn">{{ filter.name }} <small>{{ filter.operator }}</small> {{ filter.value }}
      <span @click="removeFilter" class="btn_close">
        <el-tooltip class="item" effect="dark" :content="__('Delete Filter')" placement="top-start">
          <i class="fal fa-times-circle"></i>
        </el-tooltip>
      </span>
    </el-button>

    <div class="filter_options_list_item mt-sm" v-for="(option, key) in filterOptions" :key="key">
      <el-radio v-model="filter.operator" :label="option.name">{{ option.name }}</el-radio>
      <el-input v-if="filter.operator === option.name" :ref="currentFilterInputRef" v-model="filter.value"></el-input>
    </div>

    <div class="filter_options_done_btn_wrap">
      <el-button type="primary" @click="$refs['createFilterWindow'].doClose()" class="filter_options_done_btn mt-sm">{{ __('Done') }}</el-button>
    </div>
  </el-popover>
</template>

<script>
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

  data () {
    return {
      chosenFilterType: null,
    }
  },

  mounted () {
    this.$refs['createFilterWindow'].doShow()
    this.$nextTick(function () {
      this.$refs[this.currentFilterInputRef][0].focus()
    })
  },

  watch: {
    'filter.operator': function (val) {
      this.filter.value = ''
      this.$nextTick(function () {
        this.$refs[this.currentFilterInputRef][0].focus()
      })
    }
  },

  computed: {
    filterOptions () {
      return [
        {
          name: 'is',
          type: 'input'
        },
        {
          name: 'is not',
          type: 'input'
        },
        {
          name: 'starts with',
          type: 'input'
        },
        {
          name: 'ends with',
          type: 'input'
        },
        {
          name: 'contains',
          type: 'input'
        },
        {
          name: 'does not contain',
          type: 'input'
        },
      ]
    },

    currentFilterInputRef () {
      return this.camelize(this.filter.value) + 'FilterInput'
    }
  },

  methods: {
    removeFilter () {
      this.onRemoveFilter(this.filter)
      this.$emit('remove-filter', this.filter)
    },

    camelize(str) {
      return str.replace(/(?:^\w|[A-Z]|\b\w|\s+)/g, function(match, index) {
        if (+match === 0) return ""; // or if (/\s+/.test(match)) for white spaces
        return index == 0 ? match.toLowerCase() : match.toUpperCase();
      });
    }
  }
}
</script>

<style lang="scss">
.filter_list_window {
  max-height: 200px;
  overflow: hidden;
  padding-bottom: 40px;
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
