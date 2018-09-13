<template lang="html">
  <div>
    <el-breadcrumb separator-class="el-icon-arrow-right" v-if="breadcrumbs.length > 0">
      <el-breadcrumb-item v-for="(breadcrumb, key) in breadcrumbs" :key="key">
        <a v-if="breadcrumb.url" :href="breadcrumb.url">{{ breadcrumb.title }}</a>
        <span v-else>{{ breadcrumb.title }}</span>
      </el-breadcrumb-item>
    </el-breadcrumb>

    <h1>{{ title }}</h1>
  </div>
</template>

<script>
export default {
  name: 'LayoutHeader',

  props: {
    title: {
      required: false,
      type: String,
      default: () => { return '' }
    },
    breadcrumbs: {
      required: false,
      type: Array,
      default: () => { return [] }
    }
  }
}
</script>

<style lang="css">
</style>
