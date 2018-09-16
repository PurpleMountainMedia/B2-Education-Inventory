<template lang="html">
  <div>
    <edit-form
      :data-url="`buildings/${buildingId}`"
      :index-url="indexUrl"
      :request-includes="['buildings.extra', 'buildings.timestamps']"
      :request-with="['createdBy']"
      :title="(data) => { return data.name }"
      :tag="(data) => { return data.type }"
      :breadcrumbs="breadcrumbs"
      :on-update="(data) => { $refs.listRooms.getData() }">

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

        <el-form-item label="Type">
          <el-select
            v-model="slotProps.data.type"
            :rules="{required: true}"
            prop="type">
            <el-option
              v-for="(op, key) in typeOptions"
              :value="op"
              :key="key">{{ op }}</el-option>
          </el-select>
        </el-form-item>
      </template>

      <el-card
        slot="belowCard"
        slot-scope="slotProps"
        class="mt">
        <span slot="header">{{ slotProps.data.name }} - <strong>{{ ucFirst(eiDefaults.rooms_name) }}</strong></span>
        <list-rooms
          ref="listRooms"
          :school-id="eiSchool.id"
          :building-id="buildingId"/>
      </el-card>

    </edit-form>

  </div>
</template>

<script>
export default {
  name: 'BuildingEditForm',

  components: {
    EditForm: () => import(/* webpackChunkName: "edit-form" */'components/EditForm'),
    ListRooms: () => import(/* webpackChunkName: "list-rooms" */'components/rooms/ListRooms'),
    LayoutCenterPage: () => import(/* webpackChunkName: "layout-center-page" */'components/layout/LayoutCenterPage'),
    ObjectInformation: () => import(/* webpackChunkName: "object-information" */'components/ObjectInformation')
  },

  props: {
    buildingId: {
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
      building: {},
      typeOptions: ['Building', 'Outside']
    }
  }
}
</script>

<style lang="css">
</style>
