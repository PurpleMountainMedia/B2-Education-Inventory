<template lang="html">
  <div v-loading="loading">
    <el-row justify="center" type="flex">
      <el-col :xl="12" :lg="16">
        <el-card>
          <layout-header :title="title(data)" :breadcrumbs="breadcrumbs(data)"/>
          <el-form :model="data" label-position="top">
            <slot name="form" v-bind:data="data"></slot>
          </el-form>

          <el-popover placement="top" ref="deleteItemConfirm">
            <p>{{ __('delete_confirm') }}</p>
            <div style="text-align: right; margin: 0">
              <el-button size="mini" type="text" @click="$refs.deleteItemConfirm.doClose()">{{ __('Cancel') }}</el-button>
              <el-button type="danger" size="mini" @click="deleteData">{{ __('Delete') }}</el-button>
            </div>
            <el-button slot="reference" type="danger" plain>{{ __('Delete') }}</el-button>
          </el-popover>

          <el-button :loading="loading" @click="persistData" type="primary" class="mt-sm">{{ __('Save') }}</el-button>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import api from 'utils/api'

export default {
  name: 'EditForm',

  props: {
    title: {
      required: false,
      type: Function,
      default: (data) => { return '' }
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
      default: () => { return []}
    },
    requestWithCount: {
      type: [String, Array],
      required: false,
      default: () => { return []}
    },
    requestIncludes: {
      type: [String, Array],
      required: false,
      default: () => { return [] }
    },
  },

  data () {
    return {
      loading: false,
      data: {},
      errors: {}
    }
  },

  components: {
    LayoutHeader: () => import(/* webpackChunkName: "layout-header" */'components/layout/LayoutHeader'),
  },

  mounted () {
    this.getData()
  },

  computed: {
    requestParams () {
      return {
        with: this.requestWith,
        withCount: this.requestWithCount,
        include: this.requestIncludes,
      }
    }
  },

  methods: {
    getData () {
      this.loading = true;
      this.errors = {};

      api.get({
          path: this.dataUrl,
          params: this.requestParams
        })
        .then((data) => {
          this.loading = false;
          this.data = data.data;
        })
        .catch((error) => {
          this.loading = false;
          this.errors = error;
        });
    },

    persistData () {
      this.loading = true;
      this.errors = {};

      api.persist("put", {
          path: this.dataUrl,
          object: {
            data: this.data,
            include: this.requestIncludes
          }
        })
        .then((data) => {
          this.loading = false;
          this.data = data.data;

          this.$message.success({
            message: `${this.data.name}, ${this.__('updated!')}`,
          });
        })
        .catch((error) => {
          this.loading = false;
          this.errors = error;

          this.$message.error({
            message: this.__('update_error_message'),
          });
        });
    },

    deleteData () {
      this.loading = true;
      this.errors = {};

      api.delete({
          path: this.dataUrl,
        })
        .then((data) => {
          this.loading = false;

          this.$message.success({
            message: `${this.data.name}, ${this.__('deleted!')}`,
          });

          window.location = this.indexUrl
        })
        .catch((error) => {
          this.loading = false;
          this.errors = error;

          this.$message.error({
            message: this.__('update_error_message'),
          });
        });
    }
  }
}
</script>

<style lang="css">
</style>
