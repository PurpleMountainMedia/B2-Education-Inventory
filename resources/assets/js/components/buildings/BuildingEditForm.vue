<template lang="html">
  <div>
    <edit-form :data-url="`buildings/${buildingId}`"
               :request-includes="['buildings.extra']">
      <template slot="form" slot-scope="slotProps">

        <slot v-bind:data="slotProps.data" name="card"></slot>


        <el-form-item label="Name">
          <el-input v-model="slotProps.data.name"></el-input>
        </el-form-item>

        <el-form-item label="Type">
          <el-select v-model="slotProps.data.type">
            <el-option :value="op" v-for="(op, key) in typeOptions" :key="key">{{ op }}</el-option>
          </el-select>
        </el-form-item>

      </template>
    </edit-form>
  </div>
</template>

<script>
export default {
  name: 'BuildingEditForm',

  props: {
    buildingId: {
      type: String,
      required: true
    }
  },

  data () {
    return {
      building: {},
      typeOptions: ['Building', 'Outside']
    }
  },

  components: {
    EditForm: () => import(/* webpackChunkName: "edit-form" */'components/EditForm'),
  }
}
</script>

<style lang="css">
</style>
