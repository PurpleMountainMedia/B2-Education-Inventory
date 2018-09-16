<template lang="html">
  <div>
    <el-row :gutter="10">
      <p><strong>{{ __('Information') }}</strong></p>
      <hr>
    </el-row>

    <el-row :gutter="10">
      <el-col
        :span="18"
        :offset="4">
        <el-form-item
          :label="__('Report Name')"
          :rules="[{required: true, message: __('name_required')}]"
          :error="formErrors.name"
          prop="name">
          <el-input
            v-model="form.name"
            :placeholder="`${__('Report')} ${__('name')}`"/>
        </el-form-item>
      </el-col>
    </el-row>

    <el-row :gutter="10">
      <el-col
        :span="18"
        :offset="4">
        <el-form-item
          :label="__('Report Type')"
          :rules="[{required: true, message: __('type_required')}]"
          :error="formErrors.type"
          prop="type">
          <el-select v-model="form.type">
            <el-option
              v-for="(type, key) in reportTypes"
              :key="key"
              :value="type"/>
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <el-row :gutter="10">
      <el-col
        :span="18"
        :offset="4">
        <el-form-item
          :label="__('Report Repeatable')"
          :error="formErrors.repeatable"
          prop="repeatable">
          <el-switch v-model="form.repeatable"/>
        </el-form-item>
      </el-col>
    </el-row>

    <el-row
      v-if="form.repeatable"
      :gutter="10">
      <el-col
        :span="18"
        :offset="4">
        <el-form-item
          :label="__('Repeat Every')"
          :rules="[{required: true, message: __('repeat_every_required')}]"
          :error="formErrors.repeat_every"
          prop="repeat_every">
          <el-input-number
            v-model="form.repeat_every"
            :min="1"
            controls-position="right"/>

          <el-select v-model="form.repeat_every_unit">
            <el-option
              v-for="(unit, key) in repeatUnits"
              :key="key"
              :value="unit"/>
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

  </div>
</template>

<script>
export default {
  name: 'AddNewReportFields',

  props: {
    form: {
      required: true,
      type: Object
    },
    formErrors: {
      required: true,
      type: Object
    }
  },

  computed: {
    reportTypes () {
      return ['Item', 'Room', 'Building']
    },

    repeatUnits () {
      return ['Days', 'Weeks', 'Months', 'Years']
    }
  }
}
</script>

<style lang="css">
</style>
