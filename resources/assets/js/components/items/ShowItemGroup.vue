<template lang="html">
  <layout-center-page>
    <el-card class="mb">
      <layout-header
        :title="title"
        :tag="category.name"
        :breadcrumbs="breadcrumbs" />
    </el-card>

    <list-items
      :school-id="schoolId"
      :request-params="requestParams"
      :allow-grouped="false"
      :options="options"
      url="items/group"/>
  </layout-center-page>
</template>

<script>
import api from 'utils/api'

export default {
  name: 'ShowItemGroup',

  components: {
    ListItems: () => import(/* webpackChunkName: "list-items" */'components/items/ListItems'),
    LayoutCenterPage: () => import(/* webpackChunkName: "layout-center-page" */'components/layout/LayoutCenterPage'),
    LayoutHeader: () => import(/* webpackChunkName: "layout-center-page" */'components/layout/LayoutHeader')
  },

  props: {
    category: {
      required: true,
      type: Object
    },
    room: {
      required: true,
      type: Object
    },
    itemName: {
      required: true,
      type: String
    },
    schoolId: {
      required: true,
      type: String
    },
    breadcrumbs: {
      required: false,
      type: Array,
      default: () => { return [] }
    }
  },

  data () {
    return {
      errors: {},
      data: []
    }
  },

  computed: {
    requestParams () {
      return {
        categoryId: this.category.id,
        roomId: this.room.id,
        itemName: this.itemName,
        schoolId: this.schoolId
      }
    },

    title () {
      return `${this.__('Showing')}: ${this.itemName} ${this.__('group')} ${this.__('in')} ${this.room.name}`
    },

    options () {
      return {
        display: {
          search: true
        }
      }
    }
  },

  mounted () {
    this.getGroupItems()
  },

  methods: {
    getGroupItems () {
      api.get({
        path: 'items/group',
        params: {
          categoryId: this.category.id,
          roomId: this.room.id,
          itemName: this.itemName,
          schoolId: this.schoolId
        }
      })
        .then((data) => {
          this.data = data.data
          this.errors = {}
        })
        .catch((error) => {
          this.errors = error
        })
    }
  }
}
</script>

<style lang="css">
</style>
