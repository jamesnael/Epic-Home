(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[9],{

/***/ "./Modules/ManageUser/Resources/js/components/Sales/Form.vue":
/*!*******************************************************************!*\
  !*** ./Modules/ManageUser/Resources/js/components/Sales/Form.vue ***!
  \*******************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Form.vue?vue&type=script&lang=js& */ "./Modules/ManageUser/Resources/js/components/Sales/Form.vue?vue&type=script&lang=js&");
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
component.options.__file = "Modules/ManageUser/Resources/js/components/Sales/Form.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./Modules/ManageUser/Resources/js/components/Sales/Form.vue?vue&type=script&lang=js&":
/*!********************************************************************************************!*\
  !*** ./Modules/ManageUser/Resources/js/components/Sales/Form.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Form.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./Modules/ManageUser/Resources/js/components/Sales/Form.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./Modules/ManageUser/Resources/js/components/Sales/Form.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./Modules/ManageUser/Resources/js/components/Sales/Form.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vee_validate__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vee-validate */ "./node_modules/vee-validate/dist/vee-validate.esm.js");
/* harmony import */ var vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vee-validate/dist/rules */ "./node_modules/vee-validate/dist/rules.js");
/* harmony import */ var vee_validate_dist_locale_id_json__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vee-validate/dist/locale/id.json */ "./node_modules/vee-validate/dist/locale/id.json");
var vee_validate_dist_locale_id_json__WEBPACK_IMPORTED_MODULE_2___namespace = /*#__PURE__*/__webpack_require__.t(/*! vee-validate/dist/locale/id.json */ "./node_modules/vee-validate/dist/locale/id.json", 1);



Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('required', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["required"]);
Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('email', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["email"]);
Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('numeric', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["numeric"]);
Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('image', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["image"]);
Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('regex', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["regex"]);
Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('max', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["max"]);
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
      menu3: false,
      showPassword: false,
      form_data: {
        nama: '',
        telepon: '',
        no_telepon_agent_referensi: '',
        tipe_agent: '',
        kantor_agent: '',
        email: '',
        nama_depan: '',
        nama_belakang: '',
        jenis_kelamin: '',
        tempat_lahir: '',
        tanggal_lahir: '',
        alamat: '',
        no_rekening: '',
        nama_rekening: '',
        bank: '',
        no_npwp: '',
        note: '',
        foto_ktp: '',
        foto_selfie: '',
        status_sales: ''
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
            console.log(response.data.message);
            _this.form_data = {
              nama: data.nama,
              telepon: data.telepon,
              email: data.email,
              no_telepon_agent_referensi: data.sales.no_telepon_agent_referensi,
              tipe_agent: data.sales.tipe_agent,
              kantor_agent: data.sales.kantor_agent,
              nama_depan: data.sales.nama_depan,
              nama_belakang: data.sales.nama_belakang,
              jenis_kelamin: data.sales.jenis_kelamin,
              tempat_lahir: data.sales.tempat_lahir,
              tanggal_lahir: data.sales.tanggal_lahir,
              alamat: data.sales.alamat,
              no_rekening: data.sales.no_rekening,
              nama_rekening: data.sales.nama_rekening,
              bank: data.sales.bank,
              no_npwp: data.sales.no_npwp,
              note: data.sales.note,
              foto_ktp: data.sales.foto_ktp,
              foto_selfie: data.sales.foto_selfie,
              status_sales: data.sales.status_sales,
              url_foto_ktp: data.sales.url_foto_ktp,
              url_foto_selfie: data.sales.url_foto_selfie
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
      }
    },
    clearForm: function clearForm() {
      this.form_data = {
        nama: '',
        telepon: '',
        no_telepon_agent_referensi: '',
        tipe_agent: '',
        kantor_agent: '',
        email: '',
        nama_depan: '',
        nama_belakang: '',
        jenis_kelamin: '',
        tempat_lahir: '',
        tanggal_lahir: '',
        alamat: '',
        no_rekening: '',
        nama_rekening: '',
        bank: '',
        no_npwp: '',
        note: '',
        foto_ktp: '',
        foto_selfie: '',
        status_sales: ''
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
      form_data.append("tanggal_lahir", this.form_data.tanggal_lahir ? this.form_data.tanggal_lahir : '');

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