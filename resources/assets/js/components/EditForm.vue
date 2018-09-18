<template lang="html">
  <div v-loading="loading">
    <layout-center-page>
      <b2-errors :errors="errors"/>
      <slot
        :data="data"
        name="aboveCard"/>
      <el-card>
        <layout-header
          :title="title(data)"
          :tag="tag(data)"
          :breadcrumbs="breadcrumbs(data)"
          class="mb"/>
        <el-form
          ref="editForm"
          :model="data"
          label-position="top">
          <slot
            :data="data"
            name="form"/>
        </el-form>

        <el-popover
          ref="deleteItemConfirm"
          placement="top">
          <p>{{ __('delete_confirm') }}</p>
          <div style="text-align: right; margin: 0">
            <el-button
              size="mini"
              type="text"
              @click="$refs.deleteItemConfirm.doClose()">{{ __('Cancel') }}</el-button>
            <el-button
              type="danger"
              size="mini"
              @click="deleteData">{{ __('Delete') }}</el-button>
          </div>
          <el-button
            slot="reference"
            type="danger"
            plain>{{ __('Delete') }}</el-button>
        </el-popover>

        <el-button
          :loading="loading"
          type="primary"
          class="mt-sm"
          @click="persistData">{{ __('Save') }}</el-button>
      </el-card>
      <slot
        :data="data"
        :save="persistData"
        name="belowCard"/>
    </layout-center-page>
  </div>
</template>

<script>
import api from 'utils/api'

export default {
  name: 'EditForm',

  components: {
    LayoutHeader: () => import(/* webpackChunkName: "layout-header" */'components/layout/LayoutHeader'),
    LayoutCenterPage: () => import(/* webpackChunkName: "layout-center-page" */'components/layout/LayoutCenterPage'),
    B2Errors: () => import(/* webpackChunkName: "b2-errors" */'components/B2Errors')
  },

  props: {
    title: {
      required: false,
      type: Function,
      default: (data) => { return null }
    },
    tag: {
      required: false,
      type: Function,
      default: (data) => { return null }
    },
    breadcrumbs: {
      required: false,
      type: Function,
      default: (data) => { return [] }
    },
    dataUrl: {
      required: true,
      type: String
    },
    indexUrl: {
      required: true,
      type: String
    },
    requestWith: {
      type: [String, Array],
      required: false,
      default: () => { return [] }
    },
    requestWithCount: {
      type: [String, Array],
      required: false,
      default: () => { return [] }
    },
    requestIncludes: {
      type: [String, Array],
      required: false,
      default: () => { return [] }
    },
    onUpdate: {
      type: Function,
      required: false,
      default: (data) => {}
    },
    form: {
      type: Object,
      required: false,
      default: () => { return {} }
    },
    formatData: {
      type: Function,
      required: false,
      default: (data, cb) => { cb(data) }
    }
  },

  data () {
    return {
      loading: false,
      data: {},
      errors: {}
    }
  },

  computed: {
    requestParams () {
      return {
        with: this.requestWith,
        withCount: this.requestWithCount,
        include: this.requestIncludes
      }
    }
  },

  mounted () {
    this.data = this.form
    this.getData()
  },

  methods: {
    getData () {
      this.loading = true
      this.errors = {}

      api.get({
        path: this.dataUrl,
        params: this.requestParams
      })
        .then((data) => {
          this.loading = false
          this.formatData(data.data, (data) => {
            this.data = data
          })
        })
        .catch((error) => {
          this.loading = false
          this.errors = error
        })
    },

    persistData () {
      this.loading = true
      this.errors = {}

      this.$refs.editForm.validate((valid) => {
        if (valid) {
          api.persist('put', {
            path: this.dataUrl,
            object: {
              data: this.data,
              with: this.requestWith,
              withCount: this.requestWithCount,
              include: this.requestIncludes
            }
          })
            .then((data) => {
              this.loading = false
              this.formatData(data.data, (data) => {
                this.data = data
              })
              this.onUpdate(this.data)

              this.$message({
                message: `${this.data.name}, ${this.__('updated!')}`,
                type: 'success'
              })
            })
            .catch((error) => {
              console.error(error)
              this.loading = false
              this.errors = error

              this.$message.error({
                message: this.__('update_error_message')
              })
            })
        } else {
          this.loading = false
        }
      })
    },

    deleteData () {
      this.loading = true
      this.errors = {}

      api.delete({
        path: this.dataUrl
      })
        .then((data) => {
          this.loading = false

          this.$message.success({
            message: `${this.data.name}, ${this.__('deleted!')}`
          })

          window.location = this.indexUrl
        })
        .catch((error) => {
          this.loading = false
          this.errors = error

          this.$message.error({
            message: this.__('update_error_message')
          })
        })
    }
  }
}
</script>

<style lang="css">
</style>
