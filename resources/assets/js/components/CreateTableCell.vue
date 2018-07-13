<template lang="html">
    <div>
        <el-form-item label=""
                      :rules="[{required: required, message: `${__('Row')} ${(scope.$index + 1)} ${eiDefaults.building_name} ${__('is_required')}`}]"
                      :show-message="false"
                      :prop="`rows.${scope.$index}.${scope.column.property}`">
            <el-autocomplete :autofocus="true"
                             v-if="type === 'autocomplete'"
                             @keyup.down.native="onHandleInputKey('down', `${scope.column.property}_cell_${(scope.$index + 1)}`)"
                             @keyup.up.native="onHandleInputKey('up', `${scope.column.property}_cell_${(scope.$index - 1)}`)"
                             @keyup.right.native="onHandleInputKey('right', `${rightCell}_cell_${scope.$index}`)"
                             @keyup.left.native="onHandleInputKey('left', `${leftCell}_cell_${scope.$index}`)"
                             :ref="`${scope.column.property}_cell_${scope.$index}`"
                             :fetch-suggestions="getBuildings"
                             class="table_input_cell"
                             v-model="rows[scope.$index][scope.column.property]"></el-autocomplete>

             <el-input class="table_input_cell"
                       v-else
                       :autofocus="true"
                       @keyup.down.native="onHandleInputKey('down', `${scope.column.property}_cell_${(scope.$index + 1)}`)"
                       @keyup.up.native="onHandleInputKey('up', `${scope.column.property}_cell_${(scope.$index - 1)}`)"
                       @keyup.right.native="onHandleInputKey('right', `${rightCell}_cell_${scope.$index}`)"
                       @keyup.left.native="onHandleInputKey('left', `${leftCell}_cell_${scope.$index}`)"
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
                return function (type, to) {}
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
        }
    },

    mounted () {
    },

    methods: {
        getBuildings()
        {
            //
        },

        focus()
        {
            this.$refs[`${this.scope.column.property}_cell_${this.scope.$index}`].focus();
        }
    }
}
</script>

<style lang="css">
</style>
