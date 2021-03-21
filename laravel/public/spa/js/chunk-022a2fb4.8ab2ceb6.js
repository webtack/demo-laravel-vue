(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-022a2fb4"],{"00e1":function(t,e,a){},1681:function(t,e,a){},"51e9":function(t,e,a){"use strict";var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("v-card",{attrs:{tile:"",flat:""}},[a("v-card-text",{staticClass:"pa-0 mt-3"},[a("v-form",{ref:"form",attrs:{disabled:t.loading,"lazy-validation":""},model:{value:t.isValid,callback:function(e){t.isValid=e},expression:"isValid"}},[a("v-text-field",{attrs:{rules:t.titleRules,label:"Title",outlined:"",dense:"",required:""},on:{input:t.change},model:{value:t.title,callback:function(e){t.title=e},expression:"title"}}),a("v-textarea",{attrs:{rules:t.bodyRules,label:"Body",outlined:"",dense:"",required:""},on:{input:t.change},model:{value:t.body,callback:function(e){t.body=e},expression:"body"}})],1),t.slug?a("div",{staticClass:"mb-5 pa-3 tags"},[a("news-tags-form",{attrs:{tags:t.tags},on:{change:t.addTag,delete:t.deleteTag}})],1):t._e()],1),a("v-card-actions",{staticClass:"pa-0"},[a("v-btn",{attrs:{disabled:!t.actionDisabled,color:"success"},on:{click:t.submit}},[t._v(" Save ")]),a("v-btn",{on:{click:t.cancel}},[t._v(" Cancel ")])],1)],1)},i=[],s=(a("4de4"),a("2ef0")),o=a.n(s),r=a("aa2a"),c=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[t._m(0),a("v-divider",{staticClass:"mb-3"}),a("ul",t._l(t.tags,(function(e){return a("li",{key:e.uuid},[a("div",{staticClass:"d-flex align-center justify-space-between pa-1"},[a("router-link",{attrs:{to:{name:"tags.view",params:{slug:e.slug}}}},[t._v(" #"+t._s(e.id)+" - "+t._s(e.name)+" ")]),a("v-btn",{attrs:{color:"error",icon:""},on:{click:function(a){return t.deleteTag(e.uuid)}}},[a("v-icon",[t._v("mdi-close")])],1)],1),a("v-divider")],1)})),0),t.isSelect?a("div",{staticClass:"add-tag-form mt-5 d-flex align-center justify-center"},[a("div",[a("v-select",{attrs:{items:t.selectItems,"item-text":"name","item-value":"uuid","hide-details":"",label:"Select tag",outlined:"",dense:""},on:{change:t.change}})],1),a("div",{staticClass:"ml-3"},[t.isSelect?a("tag-create",{on:{created:t.tagCreated}}):t._e()],1)]):t._e()],1)},u=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"mb-3"},[a("h3",[t._v("Tags")])])}],l=(a("7db0"),a("8020")),d=a("f0ab"),h={name:"NewsTagsForm",components:{TagCreate:d["a"]},props:{tags:{type:Array,required:!0}},computed:{selectItems:function(){var t=this;return o.a.filter(this.tagList,(function(e){var a=o.a.find(t.tags,["uuid",e.uuid]);return!a}))}},watch:{tags:function(t){this.isSelect=t.length<3}},data:function(){return{isSelect:!1,tagList:[]}},created:function(){this.fetchAllTags()},methods:{fetchAllTags:function(){var t=this;Object(l["e"])().then((function(e){t.tagList=e.data.items}))},tagCreated:function(t){this.fetchAllTags(),this.$emit("change",t)},change:function(t){this.isSelect=!1,this.$emit("change",o.a.find(this.tagList,["uuid",t]))},deleteTag:function(t){this.$emit("delete",t)}}},f=h,g=(a("b442"),a("2877")),m=a("6544"),p=a.n(m),v=a("8336"),b=a("ce7e"),w=a("132d"),y=a("b974"),C=Object(g["a"])(f,c,u,!1,null,"ea9a2f4e",null),x=C.exports;p()(C,{VBtn:v["a"],VDivider:b["a"],VIcon:w["a"],VSelect:y["a"]});var _={name:"NewsForm",components:{NewsTagsForm:x},props:{reset:{type:Boolean,default:!1},slug:{type:String,default:null}},data:function(){return{loading:!1,isValid:!1,isChange:!1,title:"",titleRules:[function(t){return!!t||"Title is required"},function(t){return t&&t.length>=10||"Title must be more than 10 characters"}],body:"",bodyRules:[function(t){return!!t||"Body is required"}],tags:[]}},computed:{actionDisabled:function(){return this.isValid&&this.isChange},payload:function(){return{item:{title:this.title,body:this.body},tags:this.tags}}},watch:{reset:function(t){t&&this.resetForm()}},mounted:function(){this.fetchItem()},methods:{fetchItem:function(){var t=this;this.slug?(this.loading=!0,Object(r["c"])(this.slug).then((function(e){t.title=e.data.item.title,t.body=e.data.item.body,t.tags=e.data.tags,t.loading=!1})).catch((function(e){console.log(e.response.data),t.loading=!1}))):this.resetForm()},change:function(){this.isChange=!0},submit:function(){this.$refs.form.validate()&&(this.slug?this.update():this.create())},update:function(){var t=this;this.loading=!0,Object(r["e"])(this.slug,this.payload).then((function(e){t.loading=!1,t.emitChangeEvent("submit")}))},create:function(){var t=this;this.loading=!0,Object(r["a"])(this.payload).then((function(e){t.loading=!1,t.emitChangeEvent("submit")}))},addTag:function(t){this.isChange=!0,this.tags.push(t)},deleteTag:function(t){this.isChange=!0,this.tags=o.a.filter(this.tags,(function(e){return e.uuid!==t}))},cancel:function(){this.emitChangeEvent("cancel")},emitChangeEvent:function(t){this.$emit(t)},resetForm:function(){this.$refs.form.resetValidation(),this.title="",this.body="",this.tags=[]}}},T=_,V=(a("7841"),a("b0af")),$=a("99d9"),I=a("4bd4"),j=a("8654"),k=a("5530"),O=(a("a9e3"),a("1681"),a("58df")),F=Object(O["a"])(j["a"]),S=F.extend({name:"v-textarea",props:{autoGrow:Boolean,noResize:Boolean,rowHeight:{type:[Number,String],default:24,validator:function(t){return!isNaN(parseFloat(t))}},rows:{type:[Number,String],default:5,validator:function(t){return!isNaN(parseInt(t,10))}}},computed:{classes:function(){return Object(k["a"])({"v-textarea":!0,"v-textarea--auto-grow":this.autoGrow,"v-textarea--no-resize":this.noResizeHandle},j["a"].options.computed.classes.call(this))},noResizeHandle:function(){return this.noResize||this.autoGrow}},watch:{lazyValue:function(){this.autoGrow&&this.$nextTick(this.calculateInputHeight)},rowHeight:function(){this.autoGrow&&this.$nextTick(this.calculateInputHeight)}},mounted:function(){var t=this;setTimeout((function(){t.autoGrow&&t.calculateInputHeight()}),0)},methods:{calculateInputHeight:function(){var t=this.$refs.input;if(t){t.style.height="0";var e=t.scrollHeight,a=parseInt(this.rows,10)*parseFloat(this.rowHeight);t.style.height=Math.max(a,e)+"px"}},genInput:function(){var t=j["a"].options.methods.genInput.call(this);return t.tag="textarea",delete t.data.attrs.type,t.data.attrs.rows=this.rows,t},onInput:function(t){j["a"].options.methods.onInput.call(this,t),this.autoGrow&&this.calculateInputHeight()},onKeyDown:function(t){this.isFocused&&13===t.keyCode&&t.stopPropagation(),this.$emit("keydown",t)}}}),H=Object(g["a"])(T,n,i,!1,null,"11f2ec17",null);e["a"]=H.exports;p()(H,{VBtn:v["a"],VCard:V["a"],VCardActions:$["a"],VCardText:$["b"],VForm:I["a"],VTextField:j["a"],VTextarea:S})},7841:function(t,e,a){"use strict";a("cde1")},aa2a:function(t,e,a){"use strict";a.d(e,"d",(function(){return i})),a.d(e,"c",(function(){return s})),a.d(e,"e",(function(){return o})),a.d(e,"a",(function(){return r})),a.d(e,"b",(function(){return c}));var n=a("b775");function i(){return Object(n["a"])({url:"news/list",method:"get"})}function s(t){return Object(n["a"])({url:"news/".concat(t),method:"get"})}function o(t,e){return Object(n["a"])({url:"news/".concat(t,"/update"),data:e,method:"post"})}function r(t){return Object(n["a"])({url:"news/create",data:t,method:"put"})}function c(t){return Object(n["a"])({url:"news/".concat(t,"/delete"),method:"delete"})}},b442:function(t,e,a){"use strict";a("00e1")},cde1:function(t,e,a){},dde5:function(t,e,a){"use strict";a.r(e);var n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return t.$route.params.slug?a("div",{staticClass:"pa-5"},[a("div",{staticClass:"d-flex align-center"},[a("h3",[t._v("Editing news")]),a("v-btn",{staticClass:"ml-3",attrs:{dark:"",fab:"",xSmall:"",color:"blue",to:{name:"news.view",params:{slug:t.$route.params.slug}}}},[a("v-icon",[t._v("mdi-eye")])],1)],1),a("news-form",{attrs:{slug:t.$route.params.slug},on:{cancel:function(e){return t.$router.go(-1)}}})],1):t._e()},i=[],s=a("51e9"),o={name:"NewsEdit",components:{NewsForm:s["a"]}},r=o,c=a("2877"),u=a("6544"),l=a.n(u),d=a("8336"),h=a("132d"),f=Object(c["a"])(r,n,i,!1,null,null,null);e["default"]=f.exports;l()(f,{VBtn:d["a"],VIcon:h["a"]})}}]);
//# sourceMappingURL=chunk-022a2fb4.8ab2ceb6.js.map