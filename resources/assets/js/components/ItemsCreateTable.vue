<template lang="html">
    <div v-loading="loading">
      <el-alert type="warning" :closable="false" title="" class="mb-sm" v-if="selectedRows.length > 0">
        <el-button @click="handelMultipleDelete" type="danger" size="mini">{{ __('Delete') }}</el-button>
      </el-alert>

      <el-form :model="{rows: rows}">
        <el-table :data="rows" @selection-change="handleSelectionChange">


          <el-table-column type="selection"
                           class-name="table_no_padding selection_col"
                           width="30">
          </el-table-column>

          <el-table-column v-for="(col, key) in collumns" :key="key" class-name="table_no_padding" :label="col.label" :prop="col.prop" :width="col.width ? col.width : '100'">
            <template slot-scope="scope">
              <create-table-cell :type="col.type ? col.type : null"
                                 :data="col.data ? col.data : []"
                                 :new-row="(type, to, from) => { addRow(); handleInputKey(type, to, from); }"
                                 :rows="rows"
                                 :scope="scope"
                                 :onAutoCompleteSelect="(value) => { handleAutoCompleteSelect(col.prop, value) }"
                                 :onAutoCompleteChange="(value) => { handleAutoCompleteChange(col.prop, value) }"
                                 :left-cell="collumns[key-1] ? collumns[key-1].prop : null"
                                 :right-cell="collumns[key+1] ? collumns[key+1].prop : null"
                                 :on-handle-input-key="handleInputKey"
                                 :ref="`${scope.column.property}_cell_${scope.$index}`"/>
            </template>
          </el-table-column>

        </el-table>
      </el-form>

      <el-button class="mt" @click="addRow" type="primary" plain>{{ __('Add Row') }}</el-button>
    </div>
</template>

<script>
var clone = require('lodash.clone')
import CreateTableCell from 'components/CreateTableCell'
import api from '../utils/api'

const row = {
    building: '',
    room: '',
    item_type: '',
    name: '',
    description: '',
    make: '',
    serial: '',
    purchase_date: '',
    purchase_price: '',
    write_off: '',
    qty: 1,
}

export default {
    name: 'ItemsCreateTable',

    components: {
        CreateTableCell: CreateTableCell
    },

    props: {
      schoolId: {
        type: [Number, String],
        required: true,
      }
    },

    data () {
      return {
          loading: false,
          rows: [clone(row)],
          test: '',
          selectedRows: [],
          buildings: [],
          rooms: [],
      }
    },

    mounted () {
      this.getBuildings()
    },

    watch: {

    },

    computed: {
      collumns () {
        return [
          {
            label: this.ucFirst(this.eiDefaults.building_name),
            prop: "building",
            width: "100",
            type: "autocomplete",
            data: this.buildings
          },
          {
            label: this.ucFirst(this.eiDefaults.room_name),
            prop: "room",
            width: "100",
            type: "autocomplete",
            data: this.rooms
          },
          {
            label: this.ucFirst(this.eiDefaults.item_type_name),
            prop: "itemType"
          },
          {
            label: this.__('Name'),
            prop: "name"
          },
          {
            label: this.__('Description'),
            prop: "description"
          },
          {
            label: this.__('Make'),
            prop: "make"
          },
          {
            label: this.__('Serial'),
            prop: 'serial'
          },
          {
            label: this.__('Purchase Date'),
            prop: 'purchaseDate'
          },
          {
            label: this.__('Purchase Price'),
            prop: 'purchasePrice'
          },
          {
            label: this.__('Write Off'),
            prop: 'writeOff'
          },
          {
            label: this.__('Quantity'),
            prop: 'qty'
          }
        ]
      }
    },

    methods: {
      addRow () {
        var newRow = clone(row)
        var rowsLength = this.rows.length-1
        var colsToDup = ['building', 'room', 'qty']

        if (rowsLength >= 0) {
          colsToDup.forEach(row => {
            newRow[row] = this.rows[rowsLength][row]
          })
        }

        this.rows.push(newRow)
      },

      handleSelectionChange (val) {
        this.selectedRows = val;
      },

      handelMultipleDelete () {
        this.selectedRows.forEach(row => {
          this.rows.splice(this.rows.indexOf(row), 1)
        })
      },

      handleInputKey (type, to, from) {
        this.$nextTick(() => {
          if (from) {
            var fromRef = this.$refs[from] ? this.$refs[from][0] : null
            if (fromRef) {
              fromRef.blur()
            }
          }
          if (to) {
            var toRef = this.$refs[to] ? this.$refs[to][0] : null;
            if (toRef) {
              toRef.focus()
            }
          }
        })
      },

      getBuildings () {
        api.get({
          path: 'buildings',
          params: {
            schoolId: this.schoolId,
            limit: 100 * 100
          }
        })
        .then(data => {
          this.buildings = data.data
        })
        .catch(error => {

        })
      },

      getRooms (buildingId) {
        api.get({
          path: `buildings/${buildingId}/rooms`,
          params: {
            limit: 100 * 100
          }
        })
        .then(data => {
          this.rooms = data.data
        })
        .catch(error => {

        })
      },

      handleAutoCompleteSelect (col, value) {
        switch (col) {
          case 'building':
            this.getRooms(value.id)
            break;
          default:

        }
      },

      handleAutoCompleteChange (col, value) {
        console.log(value)
      }
    }

}
</script>

<style lang="scss">
    .table_input_cell input {
        border-radius: 0;
    }
    .table_no_padding {
        padding: 0!important;
    }
    .table_no_padding.selection_col {
        padding: 0px 7px!important;
    }
    .table_no_padding .cell {
        padding: 0!important;
    }
    .table_no_padding .cell .el-form-item {
        margin-bottom: 0px;
        margin-top: -1px;
    }
    th.table_no_padding {
        padding: 6px 6px!important;
        background: #d6d6d6;
        color: black;
    }
    .table_no_padding .el-input__inner {
        padding: 6px;
    }
</style>
