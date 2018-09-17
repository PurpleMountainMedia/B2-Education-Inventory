webpackJsonp([23],{

/***/ "./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/reports/AddNewReportFields.vue":
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
  name: 'AddNewReportFields',

  props: {
    form: {
      required: true,
      type: Object
    },
    formErrors: {
      required: true,
      type: Object
    }
  },

  computed: {
    reportTypes: function reportTypes() {
      return ['Item', 'Room', 'Building'];
    },
    repeatUnits: function repeatUnits() {
      return ['Days', 'Weeks', 'Months', 'Years'];
    }
  }
};

/***/ }),

/***/ "./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-383aa3b3\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/reports/AddNewReportFields.vue":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-383aa3b3\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/reports/AddNewReportFields.vue":
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("el-row", { attrs: { gutter: 10 } }, [
        _c("p", [_c("strong", [_vm._v(_vm._s(_vm.__("Information")))])]),
        _vm._v(" "),
        _c("hr")
      ]),
      _vm._v(" "),
      _c(
        "el-row",
        { attrs: { gutter: 10 } },
        [
          _c(
            "el-col",
            { attrs: { span: 18, offset: 4 } },
            [
              _c(
                "el-form-item",
                {
                  attrs: {
                    label: _vm.__("Report Name"),
                    rules: [
                      { required: true, message: _vm.__("name_required") }
                    ],
                    error: _vm.formErrors.name,
                    prop: "name"
                  }
                },
                [
                  _c("el-input", {
                    attrs: {
                      placeholder: _vm.__("Report") + " " + _vm.__("name")
                    },
                    model: {
                      value: _vm.form.name,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "name", $$v)
                      },
                      expression: "form.name"
                    }
                  })
                ],
                1
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "el-row",
        { attrs: { gutter: 10 } },
        [
          _c(
            "el-col",
            { attrs: { span: 18, offset: 4 } },
            [
              _c(
                "el-form-item",
                {
                  attrs: {
                    label: _vm.__("Report Type"),
                    rules: [
                      { required: true, message: _vm.__("type_required") }
                    ],
                    error: _vm.formErrors.type,
                    prop: "type"
                  }
                },
                [
                  _c(
                    "el-select",
                    {
                      model: {
                        value: _vm.form.type,
                        callback: function($$v) {
                          _vm.$set(_vm.form, "type", $$v)
                        },
                        expression: "form.type"
                      }
                    },
                    _vm._l(_vm.reportTypes, function(type, key) {
                      return _c("el-option", {
                        key: key,
                        attrs: { value: type }
                      })
                    })
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "el-row",
        { attrs: { gutter: 10 } },
        [
          _c(
            "el-col",
            { attrs: { span: 18, offset: 4 } },
            [
              _c(
                "el-form-item",
                {
                  attrs: {
                    label: _vm.__("Report Repeatable"),
                    error: _vm.formErrors.repeatable,
                    prop: "repeatable"
                  }
                },
                [
                  _c("el-switch", {
                    model: {
                      value: _vm.form.repeatable,
                      callback: function($$v) {
                        _vm.$set(_vm.form, "repeatable", $$v)
                      },
                      expression: "form.repeatable"
                    }
                  })
                ],
                1
              )
            ],
            1
          )
        ],
        1
      ),
      _vm._v(" "),
      _vm.form.repeatable
        ? _c(
            "el-row",
            { attrs: { gutter: 10 } },
            [
              _c(
                "el-col",
                { attrs: { span: 18, offset: 4 } },
                [
                  _c(
                    "el-form-item",
                    {
                      attrs: {
                        label: _vm.__("Repeat Every"),
                        rules: [
                          {
                            required: true,
                            message: _vm.__("repeat_every_required")
                          }
                        ],
                        error: _vm.formErrors.repeat_every,
                        prop: "repeat_every"
                      }
                    },
                    [
                      _c("el-input-number", {
                        attrs: { min: 1, "controls-position": "right" },
                        model: {
                          value: _vm.form.repeat_every,
                          callback: function($$v) {
                            _vm.$set(_vm.form, "repeat_every", $$v)
                          },
                          expression: "form.repeat_every"
                        }
                      }),
                      _vm._v(" "),
                      _c(
                        "el-select",
                        {
                          model: {
                            value: _vm.form.repeat_every_unit,
                            callback: function($$v) {
                              _vm.$set(_vm.form, "repeat_every_unit", $$v)
                            },
                            expression: "form.repeat_every_unit"
                          }
                        },
                        _vm._l(_vm.repeatUnits, function(unit, key) {
                          return _c("el-option", {
                            key: key,
                            attrs: { value: unit }
                          })
                        })
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        : _vm._e()
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-383aa3b3", module.exports)
  }
}

/***/ }),

/***/ "./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-383aa3b3\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/reports/AddNewReportFields.vue":
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__("./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-383aa3b3\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/reports/AddNewReportFields.vue");
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__("./node_modules/vue-style-loader/lib/addStylesClient.js")("7fdc32d0", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-383aa3b3\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AddNewReportFields.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-383aa3b3\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AddNewReportFields.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),

/***/ "./resources/assets/js/components/reports/AddNewReportFields.vue":
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__("./node_modules/vue-style-loader/index.js!./node_modules/css-loader/index.js!./node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-383aa3b3\",\"scoped\":false,\"hasInlineConfig\":true}!./node_modules/vue-loader/lib/selector.js?type=styles&index=0!./resources/assets/js/components/reports/AddNewReportFields.vue")
}
var normalizeComponent = __webpack_require__("./node_modules/vue-loader/lib/component-normalizer.js")
/* script */
var __vue_script__ = __webpack_require__("./node_modules/babel-loader/lib/index.js?{\"cacheDirectory\":true,\"presets\":[[\"env\",{\"modules\":false,\"targets\":{\"browsers\":[\"> 2%\"],\"uglify\":true}}]],\"plugins\":[\"transform-object-rest-spread\",[\"transform-runtime\",{\"polyfill\":false,\"helpers\":false}]]}!./node_modules/vue-loader/lib/selector.js?type=script&index=0!./resources/assets/js/components/reports/AddNewReportFields.vue")
/* template */
var __vue_template__ = __webpack_require__("./node_modules/vue-loader/lib/template-compiler/index.js?{\"id\":\"data-v-383aa3b3\",\"hasScoped\":false,\"buble\":{\"transforms\":{}}}!./node_modules/vue-loader/lib/selector.js?type=template&index=0!./resources/assets/js/components/reports/AddNewReportFields.vue")
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
Component.options.__file = "resources/assets/js/components/reports/AddNewReportFields.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-383aa3b3", Component.options)
  } else {
    hotAPI.reload("data-v-383aa3b3", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});