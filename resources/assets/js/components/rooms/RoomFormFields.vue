<template lang="html">
  <div>
    <form-row>
      <p>
        <strong>{{ __('Basic Information') }}
        </strong>
      </p>
      <hr>
    </form-row>
    <form-row>
      <form-col>
        <el-form-item
          :rules="[{required: true, message: __('name_required')}]"
          :error="errors.name"
          :label="`${ucFirst(eiDefaults['room_name'])} ${__('Name')}`"
          prop="name">
          <el-input
            ref="roomName"
            v-model="form.name"/>
        </el-form-item>
      </form-col>
    </form-row>

    <form-row>
      <form-col
        :span="9">
        <el-form-item
          :rules="[{required: true, message: __('type_required')}]"
          :error="errors.type"
          :label="`${ucFirst(eiDefaults['room_name'])} ${__('Type')}`"
          prop="type">
          <el-select v-model="form.type">
            <el-option
              v-for="(type, key) in types"
              :value="type.value"
              :label="type.label"
              :key="key" />
          </el-select>
        </el-form-item>
      </form-col>

      <form-col
        :span="9"
        :first="false">
        <el-form-item
          :rules="[{required: true, message: `${ucFirst(eiDefaults['building_name'])} ${__('is_required')}`}]"
          :error="errors.type"
          :label="`${ucFirst(eiDefaults['building_name'])}`"
          prop="building">
          <el-select
            v-model="form.building"
            value-key="id"
            filterable>
            <el-option
              v-for="(building, key) in buildings"
              :value="building"
              :label="building.name"
              :key="key" />
          </el-select>
        </el-form-item>
      </form-col>
    </form-row>
  </div>
</template>

<script>
import api from 'utils/api'

export default {
  name: 'RoomFormFields',

  components: {
    FormRow: () => import(/* webpackChunkName: "form-row" */'components/layout/FormRow'),
    FormCol: () => import(/* webpackChunkName: "form-col" */'components/layout/FormCol')
  },

  props: {
    form: {
      required: true,
      type: Object
    },
    errors: {
      required: false,
      type: Object,
      default: () => { return {} }
    },
    schoolId: {
      required: true,
      type: String
    }
  },

  data () {
    return {
      buildings: [],
      buildingErrors: {}
    }
  },

  computed: {
    types () {
      return [
        {
          value: 'Room',
          label: this.ucFirst(this.eiDefaults['room_name'])
        },
        {
          value: 'Space',
          label: this.__('Space')
        }
      ]
    }
  },

  watch: {

  },

  mounted () {
    this.getBuildings()
    this.getMakes()
    this.$refs.roomName.focus()
  },

  methods: {
    getBuildings () {
      api.get({
        path: 'buildings',
        params: {
          schoolId: this.schoolId,
          limit: 1000 * 1000,
          orderBy: 'name',
          ascending: 1
        }
      })
        .then((data) => {
          this.buildings = data.data
        })
        .catch((errors) => {
          this.buildingErrors = errors
        })
    }
  }
}
</script>

<style lang="css">
</style>
