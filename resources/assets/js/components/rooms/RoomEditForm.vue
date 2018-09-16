<template lang="html">
  <div>
    <edit-form
      :data-url="`rooms/${roomId}`"
      :index-url="indexUrl"
      :request-includes="['rooms.extra', 'rooms.timestamps']"
      :request-with="['createdBy']"
      :title="(data) => { return data.name }"
      :breadcrumbs="breadcrumbs"
      :on-update="(data) => { $refs.listItems.getData() }">

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

        <b2-errors :errors="buildingErrors" />
      </template>

      <el-card
        slot="belowCard"
        slot-scope="slotProps"
        class="mt">
        <span slot="header">{{ slotProps.data.name }} - <strong>{{ ucFirst(eiDefaults.items_name) }}</strong></span>
        <list-items
          ref="listItems"
          :school-id="eiSchool.id"
          :room-id="roomId"/>
      </el-card>

    </edit-form>

  </div>
</template>

<script>
import api from 'utils/api'

export default {
  name: 'RoomEditForm',

  components: {
    EditForm: () => import(/* webpackChunkName: "edit-form" */'components/EditForm'),
    ListItems: () => import(/* webpackChunkName: "list-items" */'components/items/ListItems'),
    LayoutCenterPage: () => import(/* webpackChunkName: "layout-center-page" */'components/layout/LayoutCenterPage'),
    B2Errors: () => import(/* webpackChunkName: "b2-errors" */'components/B2Errors'),
    ObjectInformation: () => import(/* webpackChunkName: "object-information" */'components/ObjectInformation')
  },

  props: {
    roomId: {
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
      room: {},
      buildings: []
    }
  },

  mounted () {
    this.getBuildings()
  },

  methods: {
    getBuildings () {
      this.buildingErrors = {}

      api.get({
        path: 'buildings',
        params: {
          schoolId: this.eiSchool.id
        }
      })
        .then((data) => {
          this.buildings = data.data
        })
        .catch((error) => {
          this.buildingErrors = error
        })
    }
  }
}
</script>

<style lang="css">
</style>
