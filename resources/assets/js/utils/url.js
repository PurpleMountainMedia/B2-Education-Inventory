export default {

  /**
   * Serialize and object or string, ready to be placed in the url hash.
   *
   * @param mixed obj
   * @param string prefix
   * @return string
   */
  serialize (obj, prefix) {
    var str = [],
      p;
    for (p in obj) {
      if (obj.hasOwnProperty(p)) {
        var k = prefix ? prefix + "[" + p + "]" : p,
          v = obj[p];
        str.push((v !== null && typeof v === "object" && v != 'undefined') ?
          this.serialize(v, k) :
          encodeURIComponent(k) + "=" + encodeURIComponent(v));
      }
    }
    return str.join("&");
  },

  /**
   * Unserialize the url, ready to be used.
   *
   * @param mixed obj
   * @return string
   */
  unserialize (obj) {
    var newObj = {},
        p;

    for (p in obj) {
      var pathDots = decodeURIComponent(p).replace(/\[(\w+)\]/g, '.$1')
      this.buildObjectFromString(pathDots, obj[p], newObj)
    }
    return newObj
  },

  /**
   * Rebuild an object from a dot annoted string.
   *
   * @param string path
   * @param mixed value
   * @param object root
   * @return object
   */
  buildObjectFromString (path, value, root) {
    var segments = path.split('.'),
        cursor = root || window,
        segment,
        i;

    for (i = 0; i < segments.length - 1; ++i) {
      segment = segments[i];
      cursor = cursor[segment] = cursor[segment] || {}
    }

    return cursor[segments[i]] = value
  }
}
