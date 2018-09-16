<template lang="html">
  <div v-loading="loading">

    <slot
      :openModal="openModal"
      name="button">
      <el-button
        :plain="mergedButton.plain"
        :size="mergedButton.size"
        :icon="mergedButton.icon"
        :class="mergedButton.class"
        type="primary"
        @click="openModal">{{ mergedButton.text }}
      </el-button>
    </slot>

    <el-dialog
      :title="mergedModal.title"
      :visible.sync="showModal">
      <el-form
        ref="addNewForm"
        :model="form"
        label-position="top">
        <slot
          :form="form"
          :formErrors="formErrors"
          name="form">
          <el-row :gutter="10">
            <p><strong>{{ __('Information') }}</strong></p>
            <hr>
          </el-row>

          <el-row :gutter="10">
            <el-col
              :span="18"
              :offset="4">
              <el-form-item
                :label="addName + ' ' + __('Name')"
                :rules="[{required: true, message: __('name_required')}]"
                :error="formErrors.name"
                prop="name">
                <el-input
                  v-model="form.name"
                  :placeholder="`${addName} ${__('name')}`"/>
              </el-form-item>
            </el-col>
          </el-row>
        </slot>
      </el-form>

      <b2-errors :errors="formErrors" />

      <span
        slot="footer"
        class="dialog-footer">
        <slot
          :closeModal="closeModal"
          :handleSave="handleSave"
          name="footer">
          <el-button @click="closeModal('addNewForm')">{{ __('Cancel') }}</el-button>
          <el-button
            :loading="loading"
            type="primary"
            @click="handleSave">{{ __('Add') }}</el-button>
        </slot>
      </span>
    </el-dialog>
  </div>
</template>

<script>
import validation from 'utils/validation'
import api from 'utils/api'

export default {
  name: 'AddNewModal',

  components: {
    B2Errors: () => import(/* webpackChunkName: "b2-errors" */'components/B2Errors')
  },

  props: {
    addName: {
      required: true,
      type: String
    },
    dataUrl: {
      required: true,
      type: String
    },
    withRequest: {
      required: false,
      type: Object,
      default: () => { return {} }
    },
    button: {
      required: false,
      type: Object,
      default: () => ({})
    },
    modal: {
      required: false,
      type: Object,
      default: () => ({})
    },
    onUpdate: {
      type: Function,
      required: false,
      default: (data) => {}
    }
  },

  data () {
    return {
      defaultButton: {
        text: this.__('Add'),
        icon: 'el-icon-circle-plus',
        size: 'small'
      },
      defaultModal: {
        title: this.__('Add')
      },
      showModal: false,
      form: {},
      formErrors: {},
      loading: false
    }
  },

  computed: {
    mergedButton () {
      return {
        ...this.defaultButton,
        ...this.button
      }
    },

    mergedModal () {
      return {
        ...this.defaultModal,
        ...this.modal
      }
    }
  },

  methods: {

    /**
     * Handle the closure of the modal
     *
     * @return Void
     */
    closeModal (ref) {
      this.showModal = false
      this.$refs[ref].resetFields()
      this.form = {}
      this.formErrors = {}
    },

    /**
     * Handle the opening of the modal
     *
     * @return Void
     */
    openModal () {
      this.showModal = true
    },

    /**
     * Handle the save of the form
     *
     * @return Void
     */
    handleSave () {
      this.loading = true

      var object = {
        data: this.form
      }

      object = Object.assign(this.withRequest, object)

      this.$refs['addNewForm'].validate((valid, errors) => {
        if (valid) {
          api.persist('post', {
            path: this.dataUrl,
            object: object
          })
            .then((data) => {
              this.loading = false
              this.showModal = false
              this.onUpdate(data.data)
            })
            .catch(() => {
              this.loading = false
            })
        } else {
          this.loading = false
          this.formErrors = {
            message: validation.getValidationErrorMessage(),
            errors: validation.getValidationMessages(errors)
          }
          return false
        }
      })
    }
  }

}
</script>

<style lang="css">
</style>
