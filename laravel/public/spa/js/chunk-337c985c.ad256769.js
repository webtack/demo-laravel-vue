(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-337c985c"],{4618:function(t,e,n){"use strict";n.r(e);var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("v-card",{attrs:{tile:"",flat:"",loading:t.loading}},[n("v-card-title",[t._v(" "+t._s(t.item.name)+" "),t.item.slug?n("v-btn",{staticClass:"ml-3",attrs:{xSmall:"",dark:"",fab:"",color:"success",to:{name:"tags.edit",params:{slug:t.item.slug}}}},[n("v-icon",[t._v("mdi-square-edit-outline")])],1):t._e()],1),n("hr"),n("v-card-text",{staticClass:"pa-5"},[n("div",{staticClass:"mb-3"},[t._v(" You can see there is related news ")]),n("ul",t._l(t.news,(function(e){return n("li",[n("v-btn",{attrs:{text:"",to:{name:"news.view",params:{slug:e.slug}}}},[t._v(t._s(e.title))])],1)})),0)])],1)},c=[],r=n("8020"),u={name:"TagView",data:function(){return{item:[],news:[],loading:!0}},created:function(){this.fetchItem()},methods:{fetchItem:function(){var t=this;Object(r["c"])(this.$route.params.slug).then((function(e){t.item=e.data.item,t.news=e.data.news,t.loading=!1})).catch((function(e){console.log(e.response.data),t.loading=!1}))}}},s=u,i=n("2877"),o=n("6544"),l=n.n(o),d=n("8336"),f=n("b0af"),m=n("99d9"),g=n("132d"),h=Object(i["a"])(s,a,c,!1,null,null,null);e["default"]=h.exports;l()(h,{VBtn:d["a"],VCard:f["a"],VCardText:m["b"],VCardTitle:m["c"],VIcon:g["a"]})},8020:function(t,e,n){"use strict";n.d(e,"e",(function(){return c})),n.d(e,"c",(function(){return r})),n.d(e,"d",(function(){return u})),n.d(e,"f",(function(){return s})),n.d(e,"a",(function(){return i})),n.d(e,"b",(function(){return o}));var a=n("b775");function c(){return Object(a["a"])({url:"tags/list",method:"get"})}function r(t){return Object(a["a"])({url:"tags/".concat(t),method:"get"})}function u(t){return Object(a["a"])({url:"tags/".concat(t,"/exist"),method:"get"})}function s(t,e){return Object(a["a"])({url:"tags/".concat(t,"/update"),data:e,method:"post"})}function i(t){return Object(a["a"])({url:"tags/create",data:t,method:"put"})}function o(t){return Object(a["a"])({url:"tags/".concat(t,"/delete"),method:"delete"})}}}]);
//# sourceMappingURL=chunk-337c985c.ad256769.js.map