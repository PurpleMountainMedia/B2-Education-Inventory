<template lang="html">
  <el-alert
    v-if="showErrors"
    :title="errors.message"
    class="form_error mt-sm mb-sm"
    type="error"
    show-icon>
    <template>
      <template
        v-for="errors in errors.errors">
        <p
          v-for="(message, key) in errors"
          :key="key"
          class="el-alert__description">- {{ message }}</p>
      </template>
    </template>
  </el-alert>
</template>

<script>
export default {
  name: 'B2Errors',

  props: {
    errors: {
      type: Object,
      required: true
    }
  },

  computed: {

    /**
         * Whether or not to show the errors.
         *
         * @return boolean
         */
    showErrors () {
      return Object.keys(this.errors).length > 0
    }
  }
}
</script>

<style lang="css">
</style>
