webpackJsonp([8],{"+DU3":function(e,t){e.exports={render:function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",[n("edit-form",{attrs:{"data-url":"reports/"+e.reportId,"index-url":e.indexUrl,"request-includes":["reports.extra","reports.timestamps","reports.content"],"request-with":["createdBy"],title:function(e){return e.name},tag:function(e){return e.type},breadcrumbs:e.breadcrumbs},scopedSlots:e._u([{key:"aboveCard",fn:function(t){return n("div",{staticClass:"mb-sm"},[t.data.links?n("print-button",{attrs:{url:t.data.links.print}}):e._e()],1)}},{key:"form",fn:function(t){return[n("object-information",{staticClass:"mb-sm",attrs:{object:t.data}}),e._v(" "),n("el-form-item",{staticClass:"short_input",attrs:{rules:{required:!0},label:"Name",prop:"name"}},[n("el-input",{model:{value:t.data.name,callback:function(n){e.$set(t.data,"name",n)},expression:"slotProps.data.name"}})],1)]}},{key:"belowCard",fn:function(e){return[n("report-data-table",{attrs:{report:e.data}})]}}])})],1)},staticRenderFns:[]}},"1zVu":function(e,t,n){var r=n("mKJU");"string"==typeof r&&(r=[[e.i,r,""]]),r.locals&&(e.exports=r.locals);n("rjj0")("15c549dc",r,!0,{})},"VU/8":function(e,t){e.exports=function(e,t,n,r,o,s){var a,i=e=e||{},u=typeof e.default;"object"!==u&&"function"!==u||(a=e,i=e.default);var d,c="function"==typeof i?i.options:i;if(t&&(c.render=t.render,c.staticRenderFns=t.staticRenderFns,c._compiled=!0),n&&(c.functional=!0),o&&(c._scopeId=o),s?(d=function(e){(e=e||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(e=__VUE_SSR_CONTEXT__),r&&r.call(this,e),e&&e._registeredComponents&&e._registeredComponents.add(s)},c._ssrRegister=d):r&&(d=r),d){var l=c.functional,f=l?c.render:c.beforeCreate;l?(c._injectStyles=d,c.render=function(e,t){return d.call(t),f(e,t)}):c.beforeCreate=f?[].concat(f,d):[d]}return{esModule:a,exports:i,options:c}}},"g/HZ":function(e,t,n){"use strict";Object.defineProperty(t,"__esModule",{value:!0}),t.default={name:"ReportEditForm",components:{EditForm:function(){return n.e(20).then(n.bind(null,"VvUm"))},LayoutCenterPage:function(){return n.e(17).then(n.bind(null,"vRQX"))},ObjectInformation:function(){return n.e(18).then(n.bind(null,"BGEq"))},ReportDataTable:function(){return n.e(23).then(n.bind(null,"GLKp"))},PrintButton:function(){return n.e(22).then(n.bind(null,"gfp9"))}},props:{reportId:{type:String,required:!0},indexUrl:{required:!0,type:String},breadcrumbs:{required:!1,type:Function,default:function(e){return[]}}},data:function(){return{}},computed:{},watch:{},mounted:function(){},methods:{}}},h5DU:function(e,t,n){var r=n("VU/8")(n("g/HZ"),n("+DU3"),!1,function(e){n("1zVu")},null,null);e.exports=r.exports},mKJU:function(e,t,n){(e.exports=n("FZ+f")(!1)).push([e.i,"",""])},rjj0:function(e,t,n){var r="undefined"!=typeof document;if("undefined"!=typeof DEBUG&&DEBUG&&!r)throw new Error("vue-style-loader cannot be used in a non-browser environment. Use { target: 'node' } in your Webpack config to indicate a server-rendering environment.");var o=n("tTVk"),s={},a=r&&(document.head||document.getElementsByTagName("head")[0]),i=null,u=0,d=!1,c=function(){},l=null,f="data-vue-ssr-id",p="undefined"!=typeof navigator&&/msie [6-9]\b/.test(navigator.userAgent.toLowerCase());function m(e){for(var t=0;t<e.length;t++){var n=e[t],r=s[n.id];if(r){r.refs++;for(var o=0;o<r.parts.length;o++)r.parts[o](n.parts[o]);for(;o<n.parts.length;o++)r.parts.push(v(n.parts[o]));r.parts.length>n.parts.length&&(r.parts.length=n.parts.length)}else{var a=[];for(o=0;o<n.parts.length;o++)a.push(v(n.parts[o]));s[n.id]={id:n.id,refs:1,parts:a}}}}function h(){var e=document.createElement("style");return e.type="text/css",a.appendChild(e),e}function v(e){var t,n,r=document.querySelector("style["+f+'~="'+e.id+'"]');if(r){if(d)return c;r.parentNode.removeChild(r)}if(p){var o=u++;r=i||(i=h()),t=y.bind(null,r,o,!1),n=y.bind(null,r,o,!0)}else r=h(),t=function(e,t){var n=t.css,r=t.media,o=t.sourceMap;r&&e.setAttribute("media",r);l.ssrId&&e.setAttribute(f,t.id);o&&(n+="\n/*# sourceURL="+o.sources[0]+" */",n+="\n/*# sourceMappingURL=data:application/json;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(o))))+" */");if(e.styleSheet)e.styleSheet.cssText=n;else{for(;e.firstChild;)e.removeChild(e.firstChild);e.appendChild(document.createTextNode(n))}}.bind(null,r),n=function(){r.parentNode.removeChild(r)};return t(e),function(r){if(r){if(r.css===e.css&&r.media===e.media&&r.sourceMap===e.sourceMap)return;t(e=r)}else n()}}e.exports=function(e,t,n,r){d=n,l=r||{};var a=o(e,t);return m(a),function(t){for(var n=[],r=0;r<a.length;r++){var i=a[r];(u=s[i.id]).refs--,n.push(u)}t?m(a=o(e,t)):a=[];for(r=0;r<n.length;r++){var u;if(0===(u=n[r]).refs){for(var d=0;d<u.parts.length;d++)u.parts[d]();delete s[u.id]}}}};var b,g=(b=[],function(e,t){return b[e]=t,b.filter(Boolean).join("\n")});function y(e,t,n,r){var o=n?"":r.css;if(e.styleSheet)e.styleSheet.cssText=g(t,o);else{var s=document.createTextNode(o),a=e.childNodes;a[t]&&e.removeChild(a[t]),a.length?e.insertBefore(s,a[t]):e.appendChild(s)}}},tTVk:function(e,t){e.exports=function(e,t){for(var n=[],r={},o=0;o<t.length;o++){var s=t[o],a=s[0],i={id:e+":"+o,css:s[1],media:s[2],sourceMap:s[3]};r[a]?r[a].parts.push(i):n.push(r[a]={id:a,parts:[i]})}return n}}});