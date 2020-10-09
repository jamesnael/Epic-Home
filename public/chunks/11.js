(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[11],{

/***/ "./Modules/MasterData/Resources/js/components/SecondaryUnit/Form.vue":
/*!***************************************************************************!*\
  !*** ./Modules/MasterData/Resources/js/components/SecondaryUnit/Form.vue ***!
  \***************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Form.vue?vue&type=script&lang=js& */ "./Modules/MasterData/Resources/js/components/SecondaryUnit/Form.vue?vue&type=script&lang=js&");
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
component.options.__file = "Modules/MasterData/Resources/js/components/SecondaryUnit/Form.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./Modules/MasterData/Resources/js/components/SecondaryUnit/Form.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************!*\
  !*** ./Modules/MasterData/Resources/js/components/SecondaryUnit/Form.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./Form.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./Modules/MasterData/Resources/js/components/SecondaryUnit/Form.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Form_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./Modules/MasterData/Resources/js/components/SecondaryUnit/Form.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./Modules/MasterData/Resources/js/components/SecondaryUnit/Form.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************************/
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
    },
    filterTipeBangunan: {
      type: Array,
      "default": function _default() {
        return [];
      }
    },
    kelengkapanSurat: {
      type: Array,
      "default": function _default() {
        return [];
      }
    },
    furnitureTermasuk: {
      type: Array,
      "default": function _default() {
        return [];
      }
    }
  },
  data: function data() {
    return {
      form_data: {
        id_tipe_bangunan: '',
        status_unit: '',
        nama_unit: '',
        alamat: '',
        kota: '',
        kecamatan: '',
        luas_tanah: '',
        luas_bangunan: '',
        kondisi_bangunan: '',
        lebar_jalan_depan: '',
        sertifikat: '',
        atas_nama: '',
        kelengkapan_surat: [],
        jumlah_kamar_tidur: '',
        jumlah_lantai: '',
        jumlah_kamar_mandi: '',
        jumlah_garasi: '',
        listrik: '',
        line_telepon: '',
        air: '',
        furniture_termasuk: [],
        deskripsi_unit: '',
        harga_unit: '',
        harga_per_meter: '',
        jenis_pembayaran: '',
        nama_pemilik: '',
        alamat_lengkap_pemilik: '',
        no_telepon_pemilik: '',
        no_npwp_pemilik: '',
        bersedia_dipasang: '',
        jangka_waktu_pemasangan: '',
        open_house: '',
        gallery_unit: '',
        approved_status: ''
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
            var _data = response.data.data;
            _this.form_data = {
              id_tipe_bangunan: _data.id_tipe_bangunan,
              status_unit: _data.status_unit,
              nama_unit: _data.nama_unit,
              alamat: _data.alamat,
              kota: _data.kota,
              kecamatan: _data.kecamatan,
              luas_tanah: _data.luas_tanah,
              luas_bangunan: _data.luas_bangunan,
              kondisi_bangunan: _data.kondisi_bangunan,
              lebar_jalan_depan: _data.lebar_jalan_depan,
              sertifikat: _data.sertifikat,
              atas_nama: _data.atas_nama,
              kelengkapan_surat: _data.kelengkapan_surat ? _data.kelengkapan_surat : [],
              jumlah_kamar_tidur: _data.jumlah_kamar_tidur,
              jumlah_lantai: _data.jumlah_lantai,
              jumlah_kamar_mandi: _data.jumlah_kamar_mandi,
              jumlah_garasi: _data.jumlah_garasi,
              listrik: _data.listrik,
              line_telepon: _data.line_telepon,
              air: _data.air,
              furniture_termasuk: _data.furniture_termasuk ? _data.furniture_termasuk : [],
              deskripsi_unit: _data.deskripsi_unit,
              harga_unit: _data.harga_unit,
              harga_per_meter: _data.harga_per_meter,
              jenis_pembayaran: _data.jenis_pembayaran,
              nama_pemilik: _data.nama_pemilik,
              alamat_lengkap_pemilik: _data.alamat_lengkap_pemilik,
              no_telepon_pemilik: _data.no_telepon_pemilik,
              no_npwp_pemilik: _data.no_npwp_pemilik,
              bersedia_dipasang: _data.bersedia_dipasang,
              jangka_waktu_pemasangan: _data.jangka_waktu_pemasangan,
              open_house: _data.open_house,
              gallery_unit: _data.gallery_unit,
              url_gallery_unit: _data.url_gallery_unit,
              approved_status: _data.approved_status,
              for_status: _data.nama_unit
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
        id_tipe_bangunan: '',
        status_unit: '',
        nama_unit: '',
        alamat: '',
        kota: '',
        kecamatan: '',
        luas_tanah: '',
        luas_bangunan: '',
        kondisi_bangunan: '',
        lebar_jalan_depan: '',
        sertifikat: '',
        atas_nama: '',
        kelengkapan_surat: [],
        jumlah_kamar_tidur: '',
        jumlah_lantai: '',
        jumlah_kamar_mandi: '',
        jumlah_garasi: '',
        listrik: '',
        line_telepon: '',
        air: '',
        furniture_termasuk: [],
        deskripsi_unit: '',
        harga_unit: '',
        harga_per_meter: '',
        jenis_pembayaran: '',
        nama_pemilik: '',
        alamat_lengkap_pemilik: '',
        no_telepon_pemilik: '',
        no_npwp_pemilik: '',
        bersedia_dipasang: '',
        jangka_waktu_pemasangan: '',
        open_house: '',
        gallery_unit: '',
        approved_status: '',
        for_status: ''
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

      if (_.isEmpty(this.form_data.kelengkapan_surat)) {
        data.append("kelengkapan_surat[]", "");
      }

      if (_.isEmpty(this.form_data.furniture_termasuk)) {
        data.append("furniture_termasuk[]", "");
      }

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