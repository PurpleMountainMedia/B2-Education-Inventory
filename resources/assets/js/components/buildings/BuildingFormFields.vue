<template lang="html">
  <div>
    <form-row>
      <form-col>
        <el-form-item
          :rules="[{required: true, message: __('name_required')}]"
          :error="errors.name"
          :label="`${ucFirst(eiDefaults['building_name'])} ${__('Name')}`"
          prop="name">
          <el-input
            ref="buildingName"
            v-model="form.name"/>
        </el-form-item>
      </form-col>
    </form-row>

    <form-row>
      <form-col>
        <el-form-item
          :rules="[{required: true, message: __('type_required')}]"
          :error="errors.type"
          :label="`${ucFirst(eiDefaults['building_name'])} ${__('Type')}`"
          prop="type">
          <el-select v-model="form.type">
            <el-option
              v-for="(type, key) in types"
              :value="type.value"
              :label="type.label"
              :key="key" />
          </el-select>
        </el-form-item>
      </form-col>
    </form-row>
  </div>
</template>

<script>
import FormRow from 'components/layout/FormRow'
import FormCol from 'components/layout/FormCol'

export default {
  name: 'BuildingFormFields',

  components: {
    FormRow,
    FormCol
  },

  props: {
    form: {
      required: true,
      type: Object
    },
    errors: {
      required: false,
      type: Object,
      default: () => { return {} }
    }
  },

  data () {
    return {

    }
  },

  computed: {
    types () {
      return [
        {
          value: 'Building',
          label: this.ucFirst(this.eiDefaults['building_name'])
        },
        {
          value: 'Outside',
          label: this.__('Outside')
        }
      ]
    }
  },

  watch: {

  },

  mounted () {
    this.$refs.buildingName.focus()
  },

  methods: {

  }
}
</script>

<style lang="css">
</style>
