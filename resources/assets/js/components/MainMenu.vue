<template>
  <div>
    <slot
      :showNav="showNav"
      name="links"/>
    <slot
      :openMenu="openMenu"
      name="button"/>
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
