<template lang="html">
  <div>
    <edit-form
      :data-url="`items/${itemId}`"
      :index-url="indexUrl"
      :request-includes="['items.extra', 'items.timestamps']"
      :request-with="['createdBy']"
      :title="(data) => { return data.name }"
      :tag="(data) => { return data.description }"
      :breadcrumbs="breadcrumbs">

      <div
        slot="aboveCard"
        slot-scope="slotProps"
        class="mb-sm">
        <el-button
          size="mini"
          plain
          type="info">{{ __('Generate Report') }}</el-button>
      </div>

      <template
        slot="form"
        slot-scope="slotProps">
        <slot
          :data="slotProps.data"
          name="card"/>

        <object-information
          :object="slotProps.data"
          class="mb-sm" />

        <el-form-item
          :rules="{required: true}"
          label="Name"
          class="short_input"
          prop="name">
          <el-input v-model="slotProps.data.name"/>
        </el-form-item>

      </template>

      <el-card
        slot="belowCard"
        slot-scope="slotProps"
        class="mt"/>

    </edit-form>

  </div>
</template>

<script>
export default {
  name: 'BuildingEditForm',

  components: {
    EditForm: () => import(/* webpackChunkName: "edit-form" */'components/EditForm'),
    LayoutCenterPage: () => import(/* webpackChunkName: "layout-center-page" */'components/layout/LayoutCenterPage'),
    ObjectInformation: () => import(/* webpackChunkName: "object-information" */'components/ObjectInformation')
  },

  props: {
    itemId: {
      type: String,
      required: true
    },
    indexUrl: {
      required: true,
      type: String
    },
    breadcrumbs: {
      required: false,
      type: Function,
      default: (data) => { return [] }
    }
  },

  data () {
    return {
      item: {}
    }
  }
}
</script>

<style lang="css">
</style>
