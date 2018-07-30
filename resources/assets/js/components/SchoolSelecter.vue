<template lang="html">
  <div>
    <form action="/session" method="POST" ref="schoolSelecterForm">
      <input type="hidden" name="_token" :value="csrfToken">
      <input type="hidden" name="school[id]" :value="school.id">
      <el-select v-model="school" filterable name="school[name]" value-key="id" @change="handleChange">
        <el-option-group v-for="organisation in data"
                         :key="organisation.id"
                         :label="organisation.name"
                         v-if="organisation.schools.length >= 1">
          <el-option v-for="school in organisation.schools"
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
    }
  },

  data () {
    return {
      school: ''
    }
  },

  methods: {
    handleChange(val) {
      this.$nextTick(() => {
        this.$refs.schoolSelecterForm.submit();
      })
    }
  }
}
</script>

<style lang="css">
</style>
