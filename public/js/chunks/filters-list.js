webpackJsonp([14],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FiltersList.vue":
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _filters = __webpack_require__("./resources/assets/js/utils/filters.js");

var _filters2 = _interopRequireDefault(_filters);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
  name: 'FiltersList',

  components: {
    FilterComponent: function FilterComponent() {
      return __webpack_require__.e/* import() */(15).then(__webpack_require__.bind(null, "./resources/assets/js/components/FilterComponent.vue"));
    }
  },

  props: {
    filters: {
      type: Array,
      required: false,
      default: function _default() {
        return [];
      }

    }
  },

  data: function data() {
    return {
      options: [{
        name: "ID",
        value: "id",
        type: "string"
      }, {
        name: "Name",
        value: "name",
        type: "string"
      }, {
        name: "Type",
        value: "type",
        type: "string"
      }, {
        name: "Created At",
        value: "created_at",
        type: "date"
      }, {
        name: "Updated At",
        value: "updated_at",
        type: "date"
      }, {
        name: "Number of Rooms",
        value: "rooms_count",
        type: "relational_count"
      }, {
        name: "Created By",
        value: "created_by",
        type: "user"
      }],
      filterBySearch: ''
    };
  },


  computed: {
    canAddNew: function canAddNew() {
      var can = true;
      this.filters.forEach(function (filter) {
        _filters2.default.hasValue(filter) ? '' : can = false;
      });
      return can;
    },
    filteredOptions: function filteredOptions() {
      var _this = this;

      return this.filterBySearch ? this.options.filter(function (o) {
        return o.name.toUpperCase().includes(_this.filterBySearch.toUpperCase());
      }) : this.options;
    }
  },

  methods: {
    afterWindowEnters: function afterWindowEnters() {
      this.filterBySearch = '';
      this.$refs.searchInput.focus();
    },
    addFilter: function addFilter(option, popoverRef) {
      this.filters.push({
        attribute: option.value,
        operator: '',
        _attributeName: option.name,
        _operatorName: '',
        value: '',
        type: option.type,
        serverFormat: option.type === 'date' ? 'd/m/Y' : '',
        clientFormat: option.type === 'date' ? 'dd/MM/yyyy' : ''
      });

      this.$refs[popoverRef].doClose();
    },
    removeFilter: function removeFilter(filter) {
      this.filters.splice(this.filters.indexOf(filter), 1);
    }
  }
}; //
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e12cfb5c\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/sass-loader/lib/loader.js!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FiltersList.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.filter_list_btn {\n  display: block;\n  width: 100%;\n  float: left;\n  position: relative;\n  margin: 2px 0px !important;\n}\n.add_filter_window {\n  max-height: 200px;\n  overflow: scroll;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-e12cfb5c\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FiltersList.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "mt-sm" },
    [
      _vm._l(_vm.filters, function(filter, key) {
        return filter
          ? _c("filter-component", {
              key: key,
              attrs: { filter: filter, "on-remove-filter": _vm.removeFilter }
            })
          : _vm._e()
      }),
      _vm._v(" "),
      _c(
        "el-popover",
        {
          ref: "addFilterWindow",
          attrs: {
            placement: "bottom",
            title: _vm.__("Add Filter"),
            width: "250",
            trigger: "click",
            "popper-class": "add_filter_window"
          },
          on: { "after-enter": _vm.afterWindowEnters }
        },
        [
          _c(
            "el-button",
            {
              attrs: {
                slot: "reference",
                type: "text",
                disabled: !_vm.canAddNew,
                icon: "el-icon-circle-plus el-icon-right"
              },
              slot: "reference"
            },
            [_vm._v(_vm._s(_vm.__("Add Filter")) + "\n    ")]
          ),
          _vm._v(" "),
          _c("p", [_c("small", [_vm._v(_vm._s(_vm.__("Filter By")))])]),
          _vm._v(" "),
          _c("el-input", {
            ref: "searchInput",
            staticClass: "mb-sm",
            attrs: {
              size: "mini",
              placeholder: _vm.__("Search for attribute")
            },
            model: {
              value: _vm.filterBySearch,
              callback: function($$v) {
                _vm.filterBySearch = $$v
              },
              expression: "filterBySearch"
            }
          }),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "filter_list" },
            _vm._l(_vm.filteredOptions, function(option, key) {
              return _c(
                "el-button",
                {
                  key: key,
                  staticClass: "filter_list_btn",
                  on: {
                    click: function($event) {
                      _vm.addFilter(option, "addFilterWindow")
                    }
                  }
                },
                [_vm._v(_vm._s(option.name) + "\n      ")]
              )
            })
          )
        ],
        1
      )
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-e12cfb5c", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e12cfb5c\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/sass-loader/lib/loader.js!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FiltersList.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e12cfb5c\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/sass-loader/lib/loader.js!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FiltersList.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("4f053eba", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e12cfb5c\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/sass-loader/lib/loader.js!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FiltersList.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e12cfb5c\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/sass-loader/lib/loader.js!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FiltersList.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/FiltersList.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-e12cfb5c\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/sass-loader/lib/loader.js!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FiltersList.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FiltersList.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-e12cfb5c\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FiltersList.vue")
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/FiltersList.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-e12cfb5c", Component.options)
  } else {
    hotAPI.reload("data-v-e12cfb5c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});