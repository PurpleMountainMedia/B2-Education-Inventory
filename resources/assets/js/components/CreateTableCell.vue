<template lang="html">
    <div>
        <el-form-item label=""
                      :rules="[{required: required, message: `${__('Row')} ${(scope.$index + 1)} ${eiDefaults.building_name} ${__('is_required')}`}]"
                      :show-message="false"
                      :prop="`rows.${scope.$index}.${scope.column.property}`">
            <el-autocomplete :autofocus="true"
                             :fetch-suggestions="getData"
                             value-key="name"
                             v-on:select="onAutoCompleteSelect"
                             v-on:change="onAutoCompleteChange"
                             v-if="type === 'autocomplete'"
                             @keyup.enter.native="newRow('down', `${scope.column.property}_cell_${(scope.$index + 1)}`, `${scope.column.property}_cell_${scope.$index}`)"
                             @keyup.down.native="onHandleInputKey('down', `${scope.column.property}_cell_${(scope.$index + 1)}`, `${scope.column.property}_cell_${scope.$index}`)"
                             @keyup.up.native="onHandleInputKey('up', `${scope.column.property}_cell_${(scope.$index - 1)}`, `${scope.column.property}_cell_${scope.$index}`)"
                             @keyup.right.native="onHandleInputKey('right', `${rightCell}_cell_${scope.$index}`, `${scope.column.property}_cell_${scope.$index}`)"
                             @keyup.left.native="onHandleInputKey('left', `${leftCell}_cell_${scope.$index}`, `${scope.column.property}_cell_${scope.$index}`)"
                             :ref="`${scope.column.property}_cell_${scope.$index}`"
                             class="table_input_cell"
                             v-model="rows[scope.$index][scope.column.property]"></el-autocomplete>

             <el-input class="table_input_cell"
                       v-else
                       :autofocus="true"
                       @keyup.enter.native="newRow('down', `${scope.column.property}_cell_${(scope.$index + 1)}`, `${scope.column.property}_cell_${scope.$index}`)"
                       @keyup.down.native="onHandleInputKey('down', `${scope.column.property}_cell_${(scope.$index + 1)}`, `${scope.column.property}_cell_${scope.$index}`)"
                       @keyup.up.native="onHandleInputKey('up', `${scope.column.property}_cell_${(scope.$index - 1)}`, `${scope.column.property}_cell_${scope.$index}`)"
                       @keyup.right.native="onHandleInputKey('right', `${rightCell}_cell_${scope.$index}`, `${scope.column.property}_cell_${scope.$index}`)"
                       @keyup.left.native="onHandleInputKey('left', `${leftCell}_cell_${scope.$index}`, `${scope.column.property}_cell_${scope.$index}`)"
                       v-model="rows[scope.$index][scope.column.property]"
                       :ref="`${scope.column.property}_cell_${scope.$index}`"></el-input>
        </el-form-item>
    </div>
</template>

<script>
export default {
    name: "CreateTableCell",

    props: {
      scope: {
          type: Object,
          required: true
      },
      rows: {
          type: Array,
          required: true,
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
          default: () => {return 'input'}
      },
      rightCell: {
          type: String,
          required: false,
          default: () => {return null}
      },
      leftCell: {
          type: String,
          required: false,
          default: () => {return null}
      },
      required: {
          type: Boolean,
          required: false,
          default: () => {return false}
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
          return data.name.toLowerCase().indexOf(query.toLowerCase()) > -1;
        }))
      },

      focus () {
        this.$refs[`${this.scope.column.property}_cell_${this.scope.$index}`].focus();
      },

      blur () {
        var ref = this.$refs[`${this.scope.column.property}_cell_${this.scope.$index}`]
        if (typeof ref.close == 'function') {
          ref.close()
        }
      }
    }
}
</script>

<style lang="css">
</style>
