<template lang="html">
  <div :loading="loading">
    <el-row justify="center" type="flex">
      <el-col :xl="12" :lg="16">
        <el-card>
          <el-form :model="data" label-position="top">
            <slot name="form" v-bind:data="data"></slot>
          </el-form>

          <el-button @click="persistData" type="primary" class="mt-sm" plain>{{ __('Submit') }}</el-button>
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
    dataUrl: {
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
    }
  }
}
</script>

<style lang="css">
</style>
