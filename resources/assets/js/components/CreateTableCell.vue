<template lang="html">
  <div>
    <el-form-item
      :rules="[{required: required, message: `${__('Row')} ${(scope.$index + 1)} ${eiDefaults.building_name} ${__('is_required')}`}]"
      :show-message="false"
      :prop="`rows.${scope.$index}.${scope.column.property}`"
      label="">
      <el-autocomplete
        v-if="type === 'autocomplete'"
        :autofocus="false"
        :fetch-suggestions="getData"
        :ref="`${scope.column.property}_cell_${scope.$index}`"
        v-model="rows[scope.$index][scope.column.property]"
        value-key="name"
        class="table_input_cell"
        @select="onAutoCompleteSelect"
        @change="onAutoCompleteChange"
        @keyup.native="(event) => { handleKeyUp(event, scope.$index, scope.column.property) }"/>

      <el-select
        v-else-if="type === 'select'"
        v-model="rows[scope.$index][scope.column.property]"
        :ref="`${scope.column.property}_cell_${scope.$index}`"
        class="table_input_cell"
        filterable
        @keyup.native="(event) => { handleKeyUp(event, scope.$index, scope.column.property) }">
        <el-option
          v-for="item in data"
          :key="item.name"
          :label="item.name"
          :value="item.name"/>
      </el-select>

      <el-date-picker
        v-else-if="type === 'date'"
        v-model="rows[scope.$index][scope.column.property]"
        :ref="`${scope.column.property}_cell_${scope.$index}`"
        :format="eiDateFormat"
        :value-format="serverDateFormat"
        type="date"
        class="table_input_cell"
        @keyup.native="(event) => { handleKeyUp(event, scope.$index, scope.column.property) }"/>

      <el-input
        v-else
        :autofocus="false"
        :disabled="scope.column.qty > 1"
        v-model="rows[scope.$index][scope.column.property]"
        :ref="`${scope.column.property}_cell_${scope.$index}`"
        class="table_input_cell"
        @keyup.native="(event) => { handleKeyUp(event, scope.$index, scope.column.property) }"/>
    </el-form-item>
  </div>
</template>

<script>
export default {
  name: 'CreateTableCell',

  props: {
    scope: {
      type: Object,
      required: true
    },
    rows: {
      type: Array,
      required: true
    },
    onHandleInputKey: {
      type: Function,
      required: false,
      default: () => {
        return function (type, to, from) {}
      }
    },
    newRow: {
      type: Function,
      required: false,
      default: () => {
        return function (type, to, from) {}
      }
    },
    type: {
      type: String,
      required: false,
      default: () => { return 'input' }
    },
    rightCell: {
      type: String,
      required: false,
      default: () => { return null }
    },
    leftCell: {
      type: String,
      required: false,
      default: () => { return null }
    },
    required: {
      type: Boolean,
      required: false,
      default: () => { return false }
    },
    data: {
      type: Array,
      required: false,
      default: () => { return [] }
    },
    onAutoCompleteSelect: {
      type: Function,
      required: false,
      default: () => {}
    },
    onAutoCompleteChange: {
      type: Function,
      required: false,
      default: () => {}
    }
  },

  methods: {
    getData (query, cb) {
      cb(this.data.filter((data) => {
        return data.name.toLowerCase().indexOf(query.toLowerCase()) > -1
      }))
    },

    handleKeyUp (event, index, property) {
      if (((event.altKey || event.ctrlKey) && !(event.altKey && event.ctrlKey)) && event.isTrusted) {
        switch (event.key) {
          case 'ArrowRight':
            this.onHandleInputKey('right', `${this.rightCell}_cell_${index}`, `${property}_cell_${index}`)
            break
          case 'ArrowLeft':
            this.onHandleInputKey('left', `${this.leftCell}_cell_${index}`, `${property}_cell_${index}`)
            break
          case 'ArrowUp':
            this.onHandleInputKey('up', `${property}_cell_${index - 1}`, `${property}_cell_${index}`)
            break
          case 'ArrowDown':
            this.onHandleInputKey('down', `${property}_cell_${index + 1}`, `${property}_cell_${index}`)
            break
          case 'Enter':
            this.newRow('down', `${property}_cell_${(index + 1)}`, `${property}_cell_${index}`, false)
            break
        }
      }
    },

    focus () {
      this.$refs[`${this.scope.column.property}_cell_${this.scope.$index}`].focus()
    },

    blur () {
      var ref = this.$refs[`${this.scope.column.property}_cell_${this.scope.$index}`]

      if (typeof ref.hidePicker === 'function') {
        ref.hidePicker()
      } else if (typeof ref.close === 'function') {
        ref.close()
      } else if (typeof ref.blur === 'function') {
        ref.blur()
      }
    }
  }
}
</script>

<style lang="css">
</style>
