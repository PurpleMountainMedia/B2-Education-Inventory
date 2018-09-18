<template lang="html">
  <div>
    <el-form-item
      label="Description"
      class="short_input"
      prop="description">
      <el-input v-model="item.description"/>
    </el-form-item>

    <el-form-item
      :rules="{required: true}"
      label="Category"
      class="short_input"
      prop="category.name">
      <el-input v-model="item.category.name"/>
    </el-form-item>

    <el-form-item
      label="Serial"
      class="short_input"
      prop="serial_number">
      <el-input v-model="item.serial_number"/>
    </el-form-item>

    <el-form-item
      label="Make"
      class="short_input"
      prop="make.name">
      <el-input v-model="item.make.name"/>
    </el-form-item>

    <el-form-item
      label="Cost"
      class="short_input"
      prop="purchase_price">
      <el-input v-model="item.purchase_price"/>
    </el-form-item>

    <el-form-item
      label="Room"
      class="short_input"
      prop="room.name">
      <el-input v-model="item.room.name"/>
    </el-form-item>
  </div>
</template>

<script>
export default {
  name: 'ItemFormFields',

  components: {

  },

  props: {
    item: {
      required: true,
      type: Object
    }
  },

  data () {
    return {

    }
  },

  computed: {

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
