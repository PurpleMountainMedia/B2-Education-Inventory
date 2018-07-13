<template lang="html">
    <div v-loading="loading">

        <el-form :model="{rows: rows}">
            <el-table :data="rows">
                <el-table-column class-name="table_no_padding" :label="ucFirst(eiDefaults.building_name)" prop="building" width="100">
                    <template slot-scope="scope">
                        <create-table-cell type="autocomplete"
                                           :rows="rows"
                                           :scope="scope"
                                           right-cell="room"
                                           :on-handle-input-key="handleInputKey"
                                           :ref="`${scope.column.property}_cell_${scope.$index}`"/>
                    </template>
                </el-table-column>

                <el-table-column class-name="table_no_padding" :label="ucFirst(eiDefaults.room_name)" prop="room" width="100">
                    <template slot-scope="scope">
                        <create-table-cell type="autocomplete"
                                           :rows="rows"
                                           :scope="scope"
                                           left-cell="building"
                                           right-cell="item_type"
                                           :on-handle-input-key="handleInputKey"
                                           :ref="`${scope.column.property}_cell_${scope.$index}`"/>
                    </template>
                </el-table-column>

                <el-table-column class-name="table_no_padding" :label="ucFirst(eiDefaults.item_type_name)" prop="item_type" width="100">
                    <template slot-scope="scope">
                        <create-table-cell :rows="rows"
                                           :scope="scope"
                                           left-cell="room"
                                           right-cell="name"
                                           :on-handle-input-key="handleInputKey"
                                           :ref="`${scope.column.property}_cell_${scope.$index}`"/>
                    </template>
                </el-table-column>

                <el-table-column class-name="table_no_padding" :label="__('Name')" prop="name" width="100">
                    <template slot-scope="scope">
                        <create-table-cell :rows="rows"
                                           :scope="scope"
                                           left-cell="item_type"
                                           right-cell="description"
                                           :on-handle-input-key="handleInputKey"
                                           :ref="`${scope.column.property}_cell_${scope.$index}`"/>
                    </template>
                </el-table-column>

                <el-table-column class-name="table_no_padding" :label="__('Description')" prop="description" width="150">
                    <template slot-scope="scope">
                        <create-table-cell :rows="rows"
                                           :scope="scope"
                                           left-cell="name"
                                           right-cell="make"
                                           :on-handle-input-key="handleInputKey"
                                           :ref="`${scope.column.property}_cell_${scope.$index}`"/>
                    </template>
                </el-table-column>

                <el-table-column class-name="table_no_padding" :label="__('Make')" prop="make" width="100">
                    <template slot-scope="scope">
                        <create-table-cell :rows="rows"
                                           :scope="scope"
                                           left-cell="description"
                                           right-cell="serial"
                                           :on-handle-input-key="handleInputKey"
                                           :ref="`${scope.column.property}_cell_${scope.$index}`"/>
                    </template>
                </el-table-column>

                <el-table-column class-name="table_no_padding" :label="__('Serial')" prop="serial" width="100">
                    <template slot-scope="scope">
                        <create-table-cell :rows="rows"
                                           :scope="scope"
                                           left-cell="make"
                                           right-cell="purchase_date"
                                           :on-handle-input-key="handleInputKey"
                                           :ref="`${scope.column.property}_cell_${scope.$index}`"/>
                    </template>
                </el-table-column>

                <el-table-column class-name="table_no_padding" :label="__('Purchase Date')" prop="purchase_date" width="90">
                    <template slot-scope="scope">
                        <create-table-cell :rows="rows"
                                           :scope="scope"
                                           left-cell="serial"
                                           right-cell="purchase_price"
                                           :on-handle-input-key="handleInputKey"
                                           :ref="`${scope.column.property}_cell_${scope.$index}`"/>
                    </template>
                </el-table-column>

                <el-table-column class-name="table_no_padding" :label="__('Purchase Price')" prop="purchase_price" width="90">
                    <template slot-scope="scope">
                        <create-table-cell :rows="rows"
                                           :scope="scope"
                                           left-cell="purchase_date"
                                           right-cell="write_off"
                                           :on-handle-input-key="handleInputKey"
                                           :ref="`${scope.column.property}_cell_${scope.$index}`"/>
                    </template>
                </el-table-column>

                <el-table-column class-name="table_no_padding" :label="__('Write Off')" prop="write_off" width="80">
                    <template slot-scope="scope">
                        <create-table-cell :rows="rows"
                                           :scope="scope"
                                           left-cell="purchase_price"
                                           right-cell="qty"
                                           :on-handle-input-key="handleInputKey"
                                           :ref="`${scope.column.property}_cell_${scope.$index}`"/>
                    </template>
                </el-table-column>

                <el-table-column class-name="table_no_padding" :label="__('Quantity')" prop="qty" width="50">
                    <template slot-scope="scope">
                        <create-table-cell :rows="rows"
                                           :scope="scope"
                                           left-cell="write_off"
                                           :on-handle-input-key="handleInputKey"
                                           :ref="`${scope.column.property}_cell_${scope.$index}`"/>
                    </template>
                </el-table-column>

                <el-table-column class-name="table_no_padding" :label="__('Actions')" prop="actions" width="50">
                    <template slot-scope="scope">
                        <el-button @click="deleteRow(scope.$index)" type="danger">X</el-button>
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

    data () {
        return {
            loading: false,
            rows: [clone(row)],
            test: ''
        }
    },

    methods: {
        addRow()
        {
            this.rows.push(clone(row))
        },

        getBuildings(queryString, cb)
        {

        },

        handleInputKey(type, to)
        {
            if (to) {
                var ref = this.$refs[to];
                if (ref) {
                    ref.focus();
                }
            }
        },

        isMultipleItems(index)
        {
            return this.rows[index].qty > 1;
        },

        deleteRow(index)
        {
            this.rows.splice(index, 1);
        }
    }

}
</script>

<style lang="css">
    .table_input_cell input {
        border-radius: 0;
    }
    .table_no_padding {
        padding: 0!important;
    }
    .table_no_padding .cell {
        padding: 0!important;
    }
    .table_no_padding .cell .el-form-item {
        margin-bottom: 0px;
        margin-top: -1px;
    }
</style>
