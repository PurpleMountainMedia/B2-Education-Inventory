webpackJsonp([20],{"2FV8":function(t,e){t.exports={render:function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"mt"},[this.report.content?e("data-table",{attrs:{data:this.report.content,server:!1,options:this.tableOptions,"type-name":"report"}}):e("el-card",[e("h1",{staticClass:"text-center"},[this._v(this._s(this.__("Sorry, No Data")))])])],1)},staticRenderFns:[]}},"3LmS":function(t,e,n){var r=n("ewJ7");"string"==typeof r&&(r=[[t.i,r,""]]),r.locals&&(t.exports=r.locals);n("rjj0")("1ca3da1a",r,!0,{})},"3lTI":function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={name:"ReportDataTable",components:{DataTable:function(){return n.e(0).then(n.bind(null,"Af3+"))}},props:{report:{required:!0,type:Object}},data:function(){return{}},computed:{tableOptions:function(){return{display:{search:!0},columns:[{prop:"name",label:this.__("Name")},{prop:"description",label:this.__("Description")},{prop:"serial",label:this.__("Serial")},{prop:"room.name",label:this.ucFirst(this.eiDefaults.room_name)},{prop:"room.building.name",label:this.ucFirst(this.eiDefaults.building_name)}]}}},watch:{},mounted:function(){},methods:{}}},GLKp:function(t,e,n){var r=n("VU/8")(n("3lTI"),n("2FV8"),!1,function(t){n("3LmS")},null,null);t.exports=r.exports},ewJ7:function(t,e,n){(t.exports=n("FZ+f")(!1)).push([t.i,"",""])}});