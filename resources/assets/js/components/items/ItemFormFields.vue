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
      <form-col :span="9">
        <el-form-item
          :label="__('Name')"
          prop="name">
          <el-input
            ref="itemName"
            v-model="item.name"
            :placeholder="__('Laptop')"/>
        </el-form-item>
      </form-col>
      <form-col
        :span="9"
        :first="false">
        <el-form-item
          :label="__('Description / Model')"
          prop="description">
          <el-input
            v-model="item.description"
            :placeholder="__('EliteBook 850')"/>
        </el-form-item>
      </form-col>
    </form-row>

    <form-row>
      <form-col :span="9">
        <el-form-item
          :rules="{required: true}"
          :label="__('Category')"
          prop="category">
          <el-select
            v-model="item.category"
            :placeholder="__('IT Equipment')"
            filterable
            value-key="id">
            <el-option
              v-for="cat in categories"
              :value="cat"
              :label="cat.name"
              :key="cat.id" />
          </el-select>
        </el-form-item>
      </form-col>
    </form-row>

    <form-row>
      <p>
        <strong>{{ __('Extended Information') }}
        </strong>
      </p>
      <hr>
    </form-row>

    <form-row>
      <form-col :span="9">
        <el-form-item
          label="Make"
          class="short_input"
          prop="make">
          <el-select
            v-model="item.make"
            filterable
            allow-create
            value-key="id">
            <el-option
              v-for="make in makes"
              :value="make"
              :label="make.name"
              :key="make.id" />
          </el-select>
        </el-form-item>
      </form-col>

      <form-col
        :span="9"
        :first="false">
        <el-form-item
          :label="__('Serial Number')"
          prop="serial_number">
          <el-input v-model="item.serial_number"/>
        </el-form-item>
      </form-col>
    </form-row>

    <form-row>
      <form-col :span="9">
        <el-form-item
          label="Cost"
          class="short_input"
          prop="purchase_price">
          <el-input v-model="item.purchase_price">
            <template slot="prepend">£</template>
          </el-input>
        </el-form-item>
      </form-col>
    </form-row>

    <form-row>
      <p>
        <strong>{{ __('Location') }}
        </strong>
      </p>
      <hr>
    </form-row>

    <form-row>
      <form-col :span="9">
        <el-form-item
          label="Room"
          class="short_input"
          prop="room">
          <el-select
            v-model="item.room"
            value-key="id"
            filterable>
            <el-option-group
              v-for="location in locations"
              v-if="location.rooms.data.length > 0"
              :key="location.id"
              :label="location.name">
              <el-option
                v-for="room in location.rooms.data"
                :key="room.id"
                :label="room.name"
                :value="room" />
            </el-option-group>
          </el-select>
        </el-form-item>
      </form-col>
    </form-row>

  </div>
</template>

<script>
import api from 'utils/api'
import FormRow from 'components/layout/FormRow'
import FormCol from 'components/layout/FormCol'

export default {
  name: 'ItemFormFields',

  components: {
    FormRow,
    FormCol
  },

  props: {
    item: {
      required: true,
      type: Object
    },
    schoolId: {
      type: String,
      required: true
    }
  },

  data () {
    return {
      categories: [],
      makes: [],
      locations: []
    }
  },

  computed: {

  },

  watch: {

  },

  mounted () {
    this.getCategories()
    this.getMakes()
    this.getLocations()
    this.$refs.itemName.focus()
  },

  methods: {
    getCategories () {
      api.get({
        path: 'item-categories',
        params: {
          orderBy: 'name',
          limit: 1000 * 1000,
          ascending: 1
        }
      })
        .then((data) => {
          this.categories = data.data
        })
    },

    getMakes () {
      api.get({
        path: 'makes',
        params: {
          orderBy: 'name',
          limit: 1000 * 1000,
          ascending: 1
        }
      })
        .then((data) => {
          this.makes = data.data
        })
    },

    getLocations () {
      api.get({
        path: 'buildings',
        params: {
          orderBy: 'name',
          limit: 1000 * 1000,
          ascending: 1,
          with: ['rooms'],
          schoolId: this.schoolId
        }
      })
        .then((data) => {
          this.locations = data.data
        })
    }
  }
}
</script>

<style lang="css">
</style>
