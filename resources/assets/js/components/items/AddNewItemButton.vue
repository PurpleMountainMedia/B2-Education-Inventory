<template lang="html">
  <add-new-modal
    :button="button"
    :modal="{ title: `${__('New')} ${ucFirst(eiDefaults['item_name'])}` }"
    :add-name="ucFirst(eiDefaults['item_name'])"
    :with-request="{schoolId: schoolId}"
    :form="form"
    data-url="items">
    <item-form-fields
      slot="formFields"
      slot-scope="slotProps"
      :school-id="schoolId"
      :item="slotProps.form"/>
  </add-new-modal>
</template>

<script>
export default {
  name: 'AddNewItemButton',

  components: {
    AddNewModal: () => import(/* webpackChunkName: "add-new-modal" */'components/AddNewModal'),
    ItemFormFields: () => import(/* webpackChunkName: "item-form-fields" */'components/items/ItemFormFields')
  },

  props: {
    schoolId: {
      required: true,
      type: String
    }
  },

  data () {
    return {
      form: {
        room: {},
        make: {},
        category: {}
      }
    }
  },

  computed: {
    button () {
      return {
        text: `${this.__('New')} ${this.ucFirst(this.eiDefaults['item_name'])}`,
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
