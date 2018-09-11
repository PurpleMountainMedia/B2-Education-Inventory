<template lang="html">
    <div v-loading="loading">
      <el-alert type="warning" :closable="false" title="" class="mb-sm" v-if="selectedRows.length > 0">
        <el-button @click="handelMultipleDelete" type="danger" size="mini">{{ __('Delete') }}</el-button>
      </el-alert>

      <el-form :model="{rows: rows}">

        <el-form-item :label="__('Barcode Start')">
          <el-input v-model="barcodeStart"></el-input>
        </el-form-item>


        <el-table :data="rows" @selection-change="handleSelectionChange">


          <el-table-column type="selection"
                           class-name="table_no_padding selection_col"
                           width="30">
          </el-table-column>

          <el-table-column v-for="(col, key) in collumns" :key="key" class-name="table_no_padding" :label="col.label" :prop="col.prop" :width="col.width ? col.width : '100'">
            <template slot-scope="scope">
              <create-table-cell :type="col.type ? col.type : null"
                                 :data="col.data ? col.data : []"
                                 :new-row="addRow"
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

          <el-table-column class-name="table_no_padding" :label="__('Barcode Range')" prop="barcodeRange" :width="100">
            <template slot-scope="scope">
              <div class="table_cell_barcode_range">{{ calculateBarcodeRange(scope) }}</div>
            </template>
          </el-table-column>

        </el-table>
      </el-form>

      <el-button class="mt" @click="addRow" type="primary" plain>{{ __('Add More') }}</el-button>
      <el-button class="mt" @click="createItems" type="primary">{{ __('Create Items') }}</el-button>

      {{ rows }}
    </div>
</template>

<script>
var clone = require('lodash.clone')
import CreateTableCell from 'components/CreateTableCell'
import api from '../utils/api'

const row = {
    barcodeStart: 0,
    barcodeEnd: 0,
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
        itemCategories: [],
        makes: [],
        barcodeStart: 1
    }
  },

  mounted () {
    this.getBuildings()
    this.getItemCategories()
    this.getMakes()
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
          prop: "itemCategory",
          type: "select",
          data: this.itemCategories
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
          prop: "make",
          type: "autocomplete",
          data: this.makes
        },
        {
          label: this.__('Serial'),
          prop: 'serial'
        },
        {
          label: this.__('Purchase Date'),
          prop: 'purchaseDate',
          type: 'date'
        },
        {
          label: this.__('Purchase Price'),
          prop: 'purchasePrice',
        },
        {
          label: this.__('Write Off'),
          prop: 'writeOff',
          type: 'date'
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
      var colsToDup = ['building', 'room', 'itemCategory']

      if (rowsLength >= 0) {
        colsToDup.forEach(row => {
          newRow[row] = this.rows[rowsLength][row]
        })
      }

      this.rows.push(newRow)

      this.$nextTick(() => {
        if (this.$refs[`itemCategory_cell_${rowsLength+1}`]) {
          this.$refs[`itemCategory_cell_${rowsLength+1}`][0].focus()
        }
      })
    },

    handleSelectionChange (val) {
      this.selectedRows = val;
    },

    handelMultipleDelete () {
      this.selectedRows.forEach(row => {
        this.rows.splice(this.rows.indexOf(row), 1)
      })
    },

    handleInputKey (type, to, from, focus = true, blur = true) {
      this.$nextTick(() => {
        if (from) {
          var fromRef = this.$refs[from] ? this.$refs[from][0] : null
          if (fromRef && blur) {
            fromRef.blur()
          }
        }
        if (to) {
          var toRef = this.$refs[to] ? this.$refs[to][0] : null;
          if (toRef && focus) {
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

    getItemCategories () {
      api.get({
        path: `item-categories`,
        params: {
          limit: 100 * 100
        }
      })
      .then(data => {
        this.itemCategories = data.data
      })
      .catch(error => {

      })
    },

    getMakes () {
      api.get({
        path: `makes`,
        params: {
          limit: 100 * 100
        }
      })
      .then(data => {
        this.makes = data.data
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
    },

    calculateBarcodeRange (row) {

      var qty = row.row.qty ? row.row.qty : 1

      if (this.rows[row.$index-1]) {
        row.row.barcodeStart = parseInt(this.rows[row.$index-1].barcodeEnd)+1
      } else {
        var start = this.barcodeStart ? this.barcodeStart : 1
        row.row.barcodeStart = parseInt(start) + parseInt(row.$index)
      }

      row.row.barcodeEnd = row.row.barcodeStart + (parseInt(qty)-1)

      if (row.row.barcodeStart === row.row.barcodeEnd) {
        return row.row.barcodeStart
      } else {
        return `${row.row.barcodeStart} - ${row.row.barcodeEnd}`
      }
    },

    createItems () {
      this.loading = true;
      this.errors = {};

      api.persist("post", {
            path: "items/bulk",
            object: {
              items: this.rows,
              schoolId: this.schoolId,
            }
        })
        .then((data) => {
            this.loading = false;
        })
        .catch((error) => {
            this.loading = false;
            this.errors = error;
        });
    }

  },
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
