export default {

  hasValue (filter) {
    console.log(this.filterType(filter.type))
    if (this.filterType(filter.type) !== 'number') {
      var value = filter.value ? filter.value : ''
      return value.length == 0 ? false : true
    } else {
      var value = parseInt(filter.value)
      return value >= 0 ? true : false
    }
  },

  filterType (filter) {
    var type = null
    switch (filter.type) {
      case 'relational_count':
        type = 'number'
        break;
      default:
        type = filter.type
    }
    return type
  },
}
