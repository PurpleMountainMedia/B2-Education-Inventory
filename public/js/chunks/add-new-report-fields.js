webpackJsonp([27],{"8ur1":function(e,r,t){var o=t("nA2C");"string"==typeof o&&(o=[[e.i,o,""]]),o.locals&&(e.exports=o.locals);t("rjj0")("76926520",o,!0,{})},"9wF9":function(e,r,t){var o=t("VU/8")(t("JcB5"),t("VPfY"),!1,function(e){t("8ur1")},null,null);e.exports=o.exports},JcB5:function(e,r,t){"use strict";Object.defineProperty(r,"__esModule",{value:!0}),r.default={name:"AddNewReportFields",props:{form:{required:!0,type:Object},formErrors:{required:!0,type:Object},hideType:{required:!1,type:Boolean,default:function(){return!1}}},computed:{reportTypes:function(){return[{label:"Item",value:"items"},{label:"Room",value:"rooms"},{label:"Building",value:"buildings"}]},repeatUnits:function(){return["Days","Weeks","Months","Years"]}}}},VPfY:function(e,r){e.exports={render:function(){var e=this,r=e.$createElement,t=e._self._c||r;return t("div",[t("el-row",{attrs:{gutter:10}},[t("p",[t("strong",[e._v(e._s(e.__("Information")))])]),e._v(" "),t("hr")]),e._v(" "),t("el-row",{attrs:{gutter:10}},[t("el-col",{attrs:{span:18,offset:4}},[t("el-form-item",{attrs:{label:e.__("Report Name"),rules:[{required:!0,message:e.__("name_required")}],error:e.formErrors.name,prop:"name"}},[t("el-input",{attrs:{placeholder:e.__("Report")+" "+e.__("name")},model:{value:e.form.name,callback:function(r){e.$set(e.form,"name",r)},expression:"form.name"}})],1)],1)],1),e._v(" "),e.hideType?e._e():t("el-row",{attrs:{gutter:10}},[t("el-col",{attrs:{span:18,offset:4}},[t("el-form-item",{attrs:{label:e.__("Report Type"),rules:[{required:!0,message:e.__("type_required")}],error:e.formErrors.type,prop:"type"}},[t("el-select",{model:{value:e.form.type,callback:function(r){e.$set(e.form,"type",r)},expression:"form.type"}},e._l(e.reportTypes,function(e,r){return t("el-option",{key:r,attrs:{value:e.value,label:e.label}})}))],1)],1)],1),e._v(" "),t("el-row",{attrs:{gutter:10}},[t("el-col",{attrs:{span:18,offset:4}},[t("el-form-item",{attrs:{label:e.__("Report Repeatable"),error:e.formErrors.repeatable,prop:"repeatable"}},[t("el-switch",{model:{value:e.form.repeatable,callback:function(r){e.$set(e.form,"repeatable",r)},expression:"form.repeatable"}})],1)],1)],1),e._v(" "),e.form.repeatable?t("el-row",{attrs:{gutter:10}},[t("el-col",{attrs:{span:18,offset:4}},[t("el-form-item",{attrs:{label:e.__("Repeat Every"),rules:[{required:!0,message:e.__("repeatEvery_required")}],error:e.formErrors.repeatEvery,prop:"repeatEvery"}},[t("el-input-number",{attrs:{min:1,"controls-position":"right"},model:{value:e.form.repeatEvery,callback:function(r){e.$set(e.form,"repeatEvery",r)},expression:"form.repeatEvery"}}),e._v(" "),t("el-select",{model:{value:e.form.repeatEveryUnit,callback:function(r){e.$set(e.form,"repeatEveryUnit",r)},expression:"form.repeatEveryUnit"}},e._l(e.repeatUnits,function(e,r){return t("el-option",{key:r,attrs:{value:e}})}))],1)],1)],1):e._e()],1)},staticRenderFns:[]}},nA2C:function(e,r,t){(e.exports=t("FZ+f")(!1)).push([e.i,"",""])}});