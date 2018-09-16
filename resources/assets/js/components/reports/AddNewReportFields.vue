<template lang="html">
  <div>
    <el-row :gutter="10">
      <p><strong>{{ __('Information') }}</strong></p>
      <hr>
    </el-row>

    <el-row :gutter="10">
      <el-col :span="18" :offset="4">
        <el-form-item :label="__('Report Name')"
                      prop="name"
                      :rules="[{required: true, message: __('name_required')}]"
                      :error="formErrors.name">
          <el-input v-model="form.name" :placeholder="`${__('Report')} ${__('name')}`"></el-input>
        </el-form-item>
      </el-col>
    </el-row>

    <el-row :gutter="10">
      <el-col :span="18" :offset="4">
        <el-form-item :label="__('Report Type')"
                      prop="type"
                      :rules="[{required: true, message: __('type_required')}]"
                      :error="formErrors.type">
          <el-select v-model="form.type">
            <el-option v-for="(type, key) in reportTypes" :key="key" :value="type"></el-option>
          </el-select>
        </el-form-item>
      </el-col>
    </el-row>

    <el-row :gutter="10">
      <el-col :span="18" :offset="4">
        <el-form-item :label="__('Report Repeatable')"
                      prop="repeatable"
                      :error="formErrors.repeatable">
          <el-switch v-model="form.repeatable">
          </el-switch>
        </el-form-item>
      </el-col>
    </el-row>

    <el-row :gutter="10" v-if="form.repeatable">
      <el-col :span="18" :offset="4">
        <el-form-item :label="__('Repeat Every')"
                      prop="repeat_every"
                      :rules="[{required: true, message: __('repeat_every_required')}]"
                      :error="formErrors.repeat_every">
          <el-input-number v-model="form.repeat_every" controls-position="right" :min="1">
          </el-input-number>

          <el-select v-model="form.repeat_every_unit">
            <el-option v-for="(unit, key) in repeatUnits" :key="key" :value="unit"></el-option>
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
