<template lang="html">
  <div>

    <el-alert title="" type="info" :closable="false">
      <small v-if="object.created_at"><strong>{{ __('Created at') }}:</strong> {{ dateTime(object.created_at.date, serverFormat).format('DD/MM/Y') }}</small><br />
      <small v-if="object.updated_at"><strong>{{ __('Updated at') }}:</strong> {{ dateTime(object.updated_at.date, serverFormat).format('DD/MM/Y') }}</small><br />
      <small v-if="object.created_by"><strong>{{ __('Created by') }}:</strong> <a :href="object.created_by.links.url">{{ object.created_by.name }}</a></small>
    </el-alert>

  </div>
</template>

<script>
export default {
  name: 'ObjectInformation',

  props: {
    object: {
      required: true,
      type: Object,
    }
  },

  computed: {
    serverFormat () {
      return 'YYYY-MM-DD'
    }
  }
}
</script>

<style lang="css">
</style>
