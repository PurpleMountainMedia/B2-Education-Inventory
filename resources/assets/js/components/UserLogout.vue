<template lang="html">
  <div>
    <slot
      :submit="submit"
      name="text">
      <a
        class="dropdown-item"
        href="#"
        @click="submit">{{ __('Logout') }}</a>
    </slot>

    <form
      v-show="false"
      ref="logoutForm"
      :action="logoutRoute"
      method="POST">
      <input
        :value="csrfToken"
        type="hidden"
        name="_token">
    </form>
  </div>
</template>

<script>
export default {
  name: 'UserLogout',

  props: {
    csrfToken: {
      required: true,
      type: String
    },
    logoutRoute: {
      required: false,
      type: String,
      default: () => { return '/logout' }
    }
  },

  methods: {
    submit () {
      console.log('submit')
      this.$refs.logoutForm.submit()
    }
  }
}
</script>

<style lang="css">
</style>
