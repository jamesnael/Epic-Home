(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./Modules/MasterData/Resources/js/components/TipeBangunan/Form.vue":
/*!**************************************************************************!*\
  !*** ./Modules/MasterData/Resources/js/components/TipeBangunan/Form.vue ***!
  \**************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Form.vue?vue&type=script&lang=js& */ "./Modules/MasterData/Resources/js/components/TipeBangunan/Form.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "Modules/MasterData/Resources/js/components/TipeBangunan/Form.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./Modules/MasterData/Resources/js/components/TipeBangunan/Form.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************!*\
  !*** ./Modules/MasterData/Resources/js/components/TipeBangunan/Form.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Form.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./Modules/MasterData/Resources/js/components/TipeBangunan/Form.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./Modules/MasterData/Resources/js/components/TipeBangunan/Form.vue?vue&type=script&lang=js&":
/*!***********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./Modules/MasterData/Resources/js/components/TipeBangunan/Form.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vee_validate__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vee-validate */ "./node_modules/vee-validate/dist/vee-validate.esm.js");
/* harmony import */ var vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vee-validate/dist/rules */ "./node_modules/vee-validate/dist/rules.js");
/* harmony import */ var vee_validate_dist_locale_id_json__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vee-validate/dist/locale/id.json */ "./node_modules/vee-validate/dist/locale/id.json");
var vee_validate_dist_locale_id_json__WEBPACK_IMPORTED_MODULE_2___namespace = /*#__PURE__*/__webpack_require__.t(/*! vee-validate/dist/locale/id.json */ "./node_modules/vee-validate/dist/locale/id.json", 1);



Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('required', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["required"]);
Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["localize"])('id', vee_validate_dist_locale_id_json__WEBPACK_IMPORTED_MODULE_2__);
/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    ValidationObserver: vee_validate__WEBPACK_IMPORTED_MODULE_0__["ValidationObserver"],
    ValidationProvider: vee_validate__WEBPACK_IMPORTED_MODULE_0__["ValidationProvider"]
  },
  props: {
    actionForm: {
      type: String,
      required: true
    },
    redirectUri: {
      type: String,
      required: true
    },
    dataUri: {
      type: String,
      "default": ''
    }
  },
  data: function data() {
    return {
<<<<<<< HEAD
      form_data: {
        nama_tipe_bangunan: '',
        deskripsi: ''
      },
      field_state: false,
      form_alert_state: false,
      form_alert_color: '',
      form_alert_text: ''
    };
  },
  mounted: function mounted() {
    this.getFormData();
  },
  methods: {
    getFormData: function getFormData() {
      var _this = this;

      if (this.dataUri) {
        this.field_state = true;
        axios.get(this.dataUri).then(function (response) {
          if (response.data.success) {
            var data = response.data.data;
            _this.form_data = {
              nama_tipe_bangunan: data.nama_tipe_bangunan,
              deskripsi: data.deskripsi
            };
            _this.field_state = false;
          } else {
            _this.form_alert_state = true;
            _this.form_alert_color = 'error';
            _this.form_alert_text = response.data.message;
            _this.field_state = false;
          }
        })["catch"](function (error) {
          _this.form_alert_state = true;
          _this.form_alert_color = 'error';
          _this.form_alert_text = response.data.message;
          _this.field_state = false;
        });
=======
      drawer: null,
      item: 1,
      items: [{
        text: 'Real-Time',
        icon: 'mdi-clock'
      }, {
        text: 'Audience',
        icon: 'mdi-account'
      }, {
        text: 'Conversions',
        icon: 'mdi-flag'
      }]
    };
  },
  methods: {}
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./Modules/Core/Resources/js/components/BaseLayout.vue?vue&type=template&id=0cb53b22&":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./Modules/Core/Resources/js/components/BaseLayout.vue?vue&type=template&id=0cb53b22& ***!
  \**************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div")
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "default", function() { return normalizeComponent; });
/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file (except for modules).
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

function normalizeComponent (
  scriptExports,
  render,
  staticRenderFns,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier, /* server only */
  shadowMode /* vue-cli only */
) {
  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (render) {
    options.render = render
    options.staticRenderFns = staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = 'data-v-' + scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
>>>>>>> 3658018a50478f0e8a883d058d4fbe000869fc52
      }
    },
    clearForm: function clearForm() {
      this.form_data = {
        nama_tipe_bangunan: '',
        deskripsi: ''
      };
      this.$refs.observer.reset();
    },
    submitForm: function submitForm() {
      var _this2 = this;

      this.$refs.observer.validate().then(function (success) {
        if (!success) {
          return;
        }

        _this2.field_state = true;

        _this2.postFormData();
      });
    },
    postFormData: function postFormData() {
      var _this3 = this;

      var form_data = new FormData(this.$refs['post-form']);

      if (this.dataUri) {
        form_data.append("_method", "put");
      }

      axios.post(this.actionForm, form_data).then(function (response) {
        if (response.data.success) {
          _this3.form_alert_state = true;
          _this3.form_alert_color = 'success';
          _this3.form_alert_text = response.data.message;
          setTimeout(function () {
            _this3["goto"](_this3.redirectUri);
          }, 6000);
        } else {
          _this3.field_state = false;
          _this3.form_alert_state = true;
          _this3.form_alert_color = 'error';
          _this3.form_alert_text = response.data.message;
        }
      })["catch"](function (error) {
        _this3.field_state = false;
        _this3.form_alert_state = true;
        _this3.form_alert_color = 'error';
        _this3.form_alert_text = 'Oops, something went wrong. Please try again later.';
      });
    }
  }
});

/***/ })

}]);