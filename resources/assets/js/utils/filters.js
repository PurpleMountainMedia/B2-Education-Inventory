export default {

  hasValue (filter) {
    if (this.filterType(filter.type) !== 'number') {
      var value = filter.value ? filter.value : ''
      return parseInt(value.length) !== 0
    } else {
      value = parseInt(filter.value)
      return value >= 0
    }
  },

  filterType (filter) {
    var type = null
    switch (filter.type) {
      case 'relational_count':
        type = 'number'
        break
      default:
        type = filter.type
    }
    return type
  }
}
