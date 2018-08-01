webpackJsonp([10],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FilterComponent.vue":
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});
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

exports.default = {
  name: 'FilterComponent',

  props: {
    filter: {
      type: Object,
      required: true
    },
    onRemoveFilter: {
      type: Function,
      required: false,
      default: function _default() {
        return function (filter) {};
      }
    }
  },

  data: function data() {
    return {
      chosenFilterType: null
    };
  },
  mounted: function mounted() {
    this.$refs['createFilterWindow'].doShow();
    this.$nextTick(function () {
      this.$refs[this.currentFilterInputRef][0].focus();
    });
  },


  watch: {
    'filter.operator': function filterOperator(val) {
      this.filter.value = '';
      this.$nextTick(function () {
        this.$refs[this.currentFilterInputRef][0].focus();
      });
    }
  },

  computed: {
    filterOptions: function filterOptions() {
      return [{
        name: 'is',
        type: 'input'
      }, {
        name: 'is not',
        type: 'input'
      }, {
        name: 'starts with',
        type: 'input'
      }, {
        name: 'ends with',
        type: 'input'
      }, {
        name: 'contains',
        type: 'input'
      }, {
        name: 'does not contain',
        type: 'input'
      }];
    },
    currentFilterInputRef: function currentFilterInputRef() {
      return this.camelize(this.filter.value) + 'FilterInput';
    }
  },

  methods: {
    removeFilter: function removeFilter() {
      this.onRemoveFilter(this.filter);
      this.$emit('remove-filter', this.filter);
    },
    camelize: function camelize(str) {
      return str.replace(/(?:^\w|[A-Z]|\b\w|\s+)/g, function (match, index) {
        if (+match === 0) return ""; // or if (/\s+/.test(match)) for white spaces
        return index == 0 ? match.toLowerCase() : match.toUpperCase();
      });
    }
  }
};

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2f6e28fe\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/sass-loader/lib/loader.js!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FilterComponent.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.filter_list_window {\n  max-height: 200px;\n  overflow: hidden;\n  padding-bottom: 40px;\n}\nspan.btn_close {\n  margin-left: 6px;\n}\n.filter_options_done_btn {\n  display: block;\n  width: 100%;\n  border-radius: 0px 0px 3px 3px;\n}\n.filter_options_done_btn_wrap {\n  position: absolute;\n  bottom: 0px;\n  width: 100%;\n  left: 0;\n}\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-2f6e28fe\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FilterComponent.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "el-popover",
    {
      ref: "createFilterWindow",
      attrs: {
        placement: "bottom",
        width: "200",
        trigger: "click",
        "popper-class": "filter_list_window"
      }
    },
    [
      _c(
        "el-button",
        {
          staticClass: "filter_btn",
          attrs: { slot: "reference" },
          slot: "reference"
        },
        [
          _vm._v(_vm._s(_vm.filter.name) + " "),
          _c("small", [_vm._v(_vm._s(_vm.filter.operator))]),
          _vm._v(" " + _vm._s(_vm.filter.value) + "\n    "),
          _c(
            "span",
            { staticClass: "btn_close", on: { click: _vm.removeFilter } },
            [
              _c(
                "el-tooltip",
                {
                  staticClass: "item",
                  attrs: {
                    effect: "dark",
                    content: _vm.__("Delete Filter"),
                    placement: "top-start"
                  }
                },
                [_c("i", { staticClass: "fal fa-times-circle" })]
              )
            ],
            1
          )
        ]
      ),
      _vm._v(" "),
      _vm._l(_vm.filterOptions, function(option, key) {
        return _c(
          "div",
          { key: key, staticClass: "filter_options_list_item mt-sm" },
          [
            _c(
              "el-radio",
              {
                attrs: { label: option.name },
                model: {
                  value: _vm.filter.operator,
                  callback: function($$v) {
                    _vm.$set(_vm.filter, "operator", $$v)
                  },
                  expression: "filter.operator"
                }
              },
              [_vm._v(_vm._s(option.name))]
            ),
            _vm._v(" "),
            _vm.filter.operator === option.name
              ? _c("el-input", {
                  ref: _vm.currentFilterInputRef,
                  refInFor: true,
                  model: {
                    value: _vm.filter.value,
                    callback: function($$v) {
                      _vm.$set(_vm.filter, "value", $$v)
                    },
                    expression: "filter.value"
                  }
                })
              : _vm._e()
          ],
          1
        )
      }),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "filter_options_done_btn_wrap" },
        [
          _c(
            "el-button",
            {
              staticClass: "filter_options_done_btn mt-sm",
              attrs: { type: "primary" },
              on: {
                click: function($event) {
                  _vm.$refs["createFilterWindow"].doClose()
                }
              }
            },
            [_vm._v(_vm._s(_vm.__("Done")))]
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
    require("vue-hot-reload-api")      .rerender("data-v-2f6e28fe", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2f6e28fe\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/sass-loader/lib/loader.js!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FilterComponent.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2f6e28fe\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/sass-loader/lib/loader.js!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FilterComponent.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("aa7732fc", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2f6e28fe\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/sass-loader/lib/loader.js!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FilterComponent.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2f6e28fe\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/sass-loader/lib/loader.js!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./FilterComponent.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/FilterComponent.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-2f6e28fe\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/sass-loader/lib/loader.js!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/FilterComponent.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/FilterComponent.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-2f6e28fe\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/FilterComponent.vue")
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
Component.options.__file = "resources/assets/js/components/FilterComponent.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2f6e28fe", Component.options)
  } else {
    hotAPI.reload("data-v-2f6e28fe", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});