<template lang="html">
  <add-new-modal
    :button="button"
    :modal="{ title: `${__('New')} ${ucFirst(eiDefaults['room_name'])}` }"
    :add-name="ucFirst(eiDefaults['room_name'])"
    :with-request="{schoolId: schoolId}"
    data-url="rooms">
    <room-form-fields
      slot="formFields"
      slot-scope="slotProps"
      :school-id="schoolId"
      :form="slotProps.form"/>
  </add-new-modal>
</template>

<script>
export default {
  name: 'AddNewRoomButton',

  components: {
    AddNewModal: () => import(/* webpackChunkName: "add-new-modal" */'components/AddNewModal'),
    RoomFormFields: () => import(/* webpackChunkName: "room-form-fields" */'components/rooms/RoomFormFields')
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
        text: `${this.__('New')} ${this.ucFirst(this.eiDefaults['room_name'])}`,
        plain: true,
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
