<template lang="html">
  <div>
    <form
      ref="schoolSelecterForm"
      action="/session"
      method="POST">
      <input
        :value="csrfToken"
        type="hidden"
        name="_token">
      <input
        :value="school.id"
        type="hidden"
        name="school[id]">
      <el-select
        v-model="school"
        :class="selecterClass"
        :size="selecterSize"
        filterable
        name="school[name]"
        value-key="id"
        @change="handleChange">
        <el-option-group
          v-for="organisation in data"
          v-if="organisation.schools.length >= 1"
          :key="organisation.id"
          :label="organisation.name">
          <el-option
            v-for="school in organisation.schools"
            :key="school.id"
            :label="school.name"
            :value="school">{{ school.name }}
          </el-option>
        </el-option-group>
      </el-select>
    </form>
  </div>
</template>

<script>
export default {
  name: 'SchoolSelecter',

  props: {
    data: {
      type: Array,
      required: false,
      default: () => { return [] }
    },
    csrfToken: {
      type: String,
      required: true
    },
    selecterSize: {
      type: String,
      required: false,
      default: () => { return 'small' }
    },
    selecterClass: {
      type: String,
      required: false,
      default: () => { return 'school_selecter_select' }
    }
  },

  data () {
    return {
      school: ''
    }
  },

  methods: {
    handleChange (val) {
      this.$nextTick(() => {
        this.$refs.schoolSelecterForm.submit()
      })
    }
  }
}
</script>

<style lang="css">
</style>
