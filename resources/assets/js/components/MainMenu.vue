<template>
  <div class="main_menu_drop">
    <slot name="logo"/>
    <slot
      :showNav="showNav"
      name="links"/>
    <slot
      :openMenu="openMenu"
      name="button"/>
    <slot
      :showNav="showNav"
      name="user"/>
  </div>
</template>

<script>
export default {
  name: 'MainMenu',

  data () {
    return {
      showNav: false
    }
  },

  methods: {
    openMenu () {
      this.showNav = !this.showNav
    }
  }
}
</script>
