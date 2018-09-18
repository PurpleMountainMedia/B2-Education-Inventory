<template lang="html">
  <div>
    <iframe
      v-if="url"
      id="printLinkIframe"
      :src="url"
      name="printLinkIframe"
      style="position:absolute;top:-9999px;left:-9999px;border:0px;overfow:none; z-index:-1"
      @load="onPrintReady"/>
    <el-button
      :loading="loading"
      :type="mergedBtn.type"
      :plain="mergedBtn.plain"
      :size="mergedBtn.size"
      :icon="mergedBtn.icon"
      :class="mergedBtn.class"
      @click="print">{{ mergedBtn.text }}
    </el-button>
  </div>
</template>

<script>
export default {
  name: 'PrintButton',

  components: {

  },

  props: {
    button: {
      required: false,
      type: Object,
      default: () => { return {} }
    },
    url: {
      required: true,
      type: String
    }
  },

  data () {
    return {
      defaultBtn: {
        type: 'primary',
        size: 'small',
        plain: true,
        text: this.__('Print')
      },
      loading: true
    }
  },

  computed: {
    mergedBtn () {
      return {
        ...this.defaultBtn,
        ...this.button
      }
    }
  },

  watch: {

  },

  mounted () {

  },

  methods: {
    onPrintReady () {
      this.loading = false
    },

    print () {
      if (navigator.userAgent.match(/opera/i) || navigator.userAgent.match(/trident/i) || (navigator.userAgent.match(/msie/i) && window.addEventListener)) {
        window.open(
          this.url,
          '_blank'
        )
      } else {
        frames['printLinkIframe'].focus()
        frames['printLinkIframe'].print()
      }
    }
  }
}
</script>

<style lang="css">
</style>
