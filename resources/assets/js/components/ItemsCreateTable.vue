<template lang="html">
  <div v-loading="loading">
    <layout-center-page>
      <el-alert
        v-if="selectedRows.length > 0"
        :closable="false"
        type="warning"
        title=""
        class="mb-sm">
        <el-button
          type="danger"
          size="mini"
          @click="handelMultipleDelete">{{ __('Delete') }}</el-button>
      </el-alert>

      <b2-errors :errors="errors" />

      <el-form
        :model="{rows: rows}"
        label-position="top">
        <el-form-item :label="__('Barcode Start')">
          <el-input
            v-model="barcodeStart"
            class="short_input"/>
        </el-form-item>

        <el-table
          :data="rows"
          @selection-change="handleSelectionChange">
          <el-table-column
            type="selection"
            class-name="table_no_padding selection_col"
            width="30"/>

          <el-table-column
            v-for="(col, key) in collumns"
            :key="key"
            :label="col.label"
            :prop="col.prop"
            :width="col.width ? col.width : '100'"
            class-name="table_no_padding">
            <template slot-scope="scope">
              <create-table-cell
                :type="col.type ? col.type : null"
                :data="col.data ? col.data : []"
                :new-row="addRow"
                :rows="rows"
                :scope="scope"
                :on-auto-complete-select="(value) => { handleAutoCompleteSelect(col.prop, value) }"
                :on-auto-complete-change="(value) => { handleAutoCompleteChange(col.prop, value) }"
                :left-cell="collumns[key-1] ? collumns[key-1].prop : null"
                :right-cell="collumns[key+1] ? collumns[key+1].prop : null"
                :on-handle-input-key="handleInputKey"
                :ref="`${scope.column.property}_cell_${scope.$index}`"/>
            </template>
          </el-table-column>

          <el-table-column
            :label="__('Barcode Range')"
            :width="100"
            class-name="table_no_padding"
            prop="barcodeRange">
            <template slot-scope="scope">
              <div class="table_cell_barcode_range">{{ calculateBarcodeRange(scope) }}</div>
            </template>
          </el-table-column>

        </el-table>
      </el-form>

      <el-button
        class="mt"
        type="primary"
        plain
        @click="addRow">{{ __('Add More') }}</el-button>
      <el-button
        class="mt"
        type="primary"
        @click="createItems">{{ __('Create Items') }}</el-button>
    </layout-center-page>
  </div>
</template>

<script>
import CreateTableCell from 'components/CreateTableCell'
import api from '../utils/api'
var clone = require('lodash.clone')

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
  qty: 1
}

export default {
  name: 'ItemsCreateTable',

  components: {
    CreateTableCell: CreateTableCell,
    LayoutCenterPage: () => import(/* webpackChunkName: "layout-center-page" */'components/layout/LayoutCenterPage'),
    B2Errors: () => import(/* webpackChunkName: "b2-errors" */'components/B2Errors')
  },

  props: {
    schoolId: {
      type: [Number, String],
      required: true
    }
  },

  data () {
    return {
      loading: false,
      rows: [clone(row)],
      test: '',
      errors: {},
      selectedRows: [],
      buildings: [],
      rooms: [],
      itemCategories: [],
      makes: [],
      barcodeStart: 1
    }
  },

  computed: {
    collumns () {
      return [
        {
          label: this.ucFirst(this.eiDefaults.building_name),
          prop: 'building',
          width: '100',
          type: 'autocomplete',
          data: this.buildings
        },
        {
          label: this.ucFirst(this.eiDefaults.room_name),
          prop: 'room',
          width: '100',
          type: 'autocomplete',
          data: this.rooms
        },
        {
          label: this.ucFirst(this.eiDefaults.item_type_name),
          prop: 'itemCategory',
          type: 'select',
          data: this.itemCategories
        },
        {
          label: this.__('Name'),
          prop: 'name'
        },
        {
          label: this.__('Description'),
          prop: 'description'
        },
        {
          label: this.__('Make'),
          prop: 'make',
          type: 'autocomplete',
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
          prop: 'purchasePrice'
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

  watch: {
    rows: {
      handler () {
        localStorage.setItem('itemAddRows', JSON.stringify(this.rows))
      },
      deep: true
    }
  },

  mounted () {
    if (localStorage.getItem('itemAddRows')) {
      this.rows = JSON.parse(localStorage.getItem('itemAddRows'))
    }
    this.getBuildings()
    this.getItemCategories()
    this.getMakes()
  },

  methods: {
    addRow () {
      var newRow = clone(row)
      var rowsLength = this.rows.length - 1
      var colsToDup = ['building', 'room', 'itemCategory']

      if (rowsLength >= 0) {
        colsToDup.forEach(row => {
          newRow[row] = this.rows[rowsLength][row]
        })
      }

      this.rows.push(newRow)

      this.$nextTick(() => {
        if (this.$refs[`itemCategory_cell_${rowsLength + 1}`]) {
          this.$refs[`itemCategory_cell_${rowsLength + 1}`][0].focus()
        }
      })
    },

    handleSelectionChange (val) {
      this.selectedRows = val
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
          var toRef = this.$refs[to] ? this.$refs[to][0] : null
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
    },

    handleAutoCompleteSelect (col, value) {
      switch (col) {
        case 'building':
          this.getRooms(value.id)
          break
        default:
      }
    },

    handleAutoCompleteChange (col, value) {
      console.log(value)
    },

    calculateBarcodeRange (row) {
      var qty = row.row.qty ? row.row.qty : 1

      if (this.rows[row.$index - 1]) {
        row.row.barcodeStart = parseInt(this.rows[row.$index - 1].barcodeEnd) + 1
      } else {
        var start = this.barcodeStart ? this.barcodeStart : 1
        row.row.barcodeStart = parseInt(start) + parseInt(row.$index)
      }

      row.row.barcodeEnd = row.row.barcodeStart + (parseInt(qty) - 1)

      if (row.row.barcodeStart === row.row.barcodeEnd) {
        return row.row.barcodeStart
      } else {
        return `${row.row.barcodeStart} - ${row.row.barcodeEnd}`
      }
    },

    createItems () {
      this.loading = true
      this.errors = {}

      api.persist('post', {
        path: 'items/bulk',
        object: {
          items: this.rows,
          schoolId: this.schoolId
        }
      })
        .then((data) => {
          this.loading = false
          this.rows = [clone(row)]
        })
        .catch((error) => {
          this.loading = false
          this.errors = error
        })
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
