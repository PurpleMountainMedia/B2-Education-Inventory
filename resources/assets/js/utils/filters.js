export default {

  hasValue (filter) {
    if (filter.type !== 'number') {
      var value = filter.value ? filter.value : ''
      return value.length == 0 ? false : true
    } else {
      var value = parseInt(filter.value)
      return value >= 0 ? true : false
    }
  }
}
