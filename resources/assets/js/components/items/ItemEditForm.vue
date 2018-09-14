<template lang="html">
  <div>
    <edit-form :data-url="`items/${itemId}`"
               :index-url="indexUrl"
               :request-includes="['items.extra', 'items.timestamps']"
               :request-with="['createdBy']"
               :title="(data) => { return data.name }"
               :tag="(data) => { return data.description }"
               :breadcrumbs="breadcrumbs">


      <div slot="aboveCard" slot-scope="slotProps" class="mb-sm">
        <el-button size="mini" plain type="info">{{ __('Generate Report') }}</el-button>
      </div>


      <template slot="form" slot-scope="slotProps">
        <slot v-bind:data="slotProps.data" name="card"></slot>

        <object-information class="mb-sm" :object="slotProps.data" />

        <el-form-item label="Name" class="short_input" prop="name" :rules="{required: true}">
          <el-input v-model="slotProps.data.name"></el-input>
        </el-form-item>

      </template>

      <el-card slot="belowCard" slot-scope="slotProps" class="mt">

      </el-card>

    </edit-form>

  </div>
</template>

<script>
export default {
  name: 'BuildingEditForm',

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
    },
  },

  data () {
    return {
      item: {},
    }
  },

  components: {
    EditForm: () => import(/* webpackChunkName: "edit-form" */'components/EditForm'),
    LayoutCenterPage: () => import(/* webpackChunkName: "layout-center-page" */'components/layout/LayoutCenterPage'),
    ObjectInformation: () => import(/* webpackChunkName: "object-information" */'components/ObjectInformation'),
  }
}
</script>

<style lang="css">
</style>
