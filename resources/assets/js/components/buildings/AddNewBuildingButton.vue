<template lang="html">
  <add-new-modal
    :button="button"
    :modal="{ title: `${__('New')} ${ucFirst(eiDefaults['building_name'])}` }"
    :add-name="ucFirst(eiDefaults['building_name'])"
    :with-request="{schoolId: schoolId}"
    data-url="buildings">
    <building-form-fields
      slot="formFields"
      slot-scope="slotProps"
      :form="slotProps.form"/>
  </add-new-modal>
</template>

<script>
export default {
  name: 'AddNewBuildingButton',

  components: {
    AddNewModal: () => import(/* webpackChunkName: "add-new-modal" */'components/AddNewModal'),
    BuildingFormFields: () => import(/* webpackChunkName: "building-form-fields" */'components/buildings/BuildingFormFields')
  },

  props: {
    schoolId: {
      required: true,
      type: String
    }
  },

  data () {
    return {

    }
  },

  computed: {
    button () {
      return {
        text: `${this.__('New')} ${this.ucFirst(this.eiDefaults['building_name'])}`,
        size: 'large',
        class: 'w-100'
      }
    }
  },

  watch: {

  },

  mounted () {

  },

  methods: {

  }
}
</script>

<style lang="css">
</style>
