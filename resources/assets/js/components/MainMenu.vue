<template>
  <div>
      <slot :showNav="showNav" name="links"></slot>
      <slot name="button" :openMenu="openMenu"></slot>
  </div>
</template>

<script>
    export default {
        name: 'MainMenu',

        data () {
            return {
                showNav: false,
            }
        },

        methods: {
            openMenu()
            {
                this.showNav = !this.showNav;
            }
        }
    }
</script>
