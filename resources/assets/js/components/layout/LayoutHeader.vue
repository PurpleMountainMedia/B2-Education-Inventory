<template lang="html">
  <div>
    <el-breadcrumb
      v-if="breadcrumbs.length > 0"
      separator-class="el-icon-arrow-right">
      <el-breadcrumb-item
        v-for="(breadcrumb, key) in breadcrumbs"
        :key="key">
        <a
          v-if="breadcrumb.url"
          :href="breadcrumb.url">{{ breadcrumb.title }}</a>
        <span v-else>{{ breadcrumb.title }}</span>
      </el-breadcrumb-item>
    </el-breadcrumb>

    <h1
      v-if="title"
      class="mb-0">{{ title }}</h1>
    <el-tag
      v-if="tag"
      type="info"
      size="mini">{{ tag }}</el-tag>
  </div>
</template>

<script>
export default {
  name: 'LayoutHeader',

  props: {
    title: {
      required: false,
      type: String,
      default: () => { return null }
    },
    tag: {
      required: false,
      type: String,
      default: () => { return null }
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
