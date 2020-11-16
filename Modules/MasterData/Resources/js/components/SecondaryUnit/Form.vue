<script type="text/javascript">
	import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate';
	import { required, email, numeric, image, regex, max } from 'vee-validate/dist/rules'
	import id from 'vee-validate/dist/locale/id.json'

	extend('required', required)
	extend('email', email)
	extend('numeric', numeric)
	extend('image', image)
	extend('regex', regex)
	extend('max', max)
    localize('id', id);

	export default {
		components: {
		    ValidationObserver,
		    ValidationProvider
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
				default: ''
			},
			filterTipeBangunan: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			kelengkapanSurat: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			furnitureTermasuk: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterOpenHouse: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterJenisPembayaran: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterStatusUnit: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterSertifikat: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterBersediaDipasang: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterApprovedStatus: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterNamaSales: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterKondisiBangunan: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
		},
		data: () => ({
			show_maps: true,
			start_date: false,
			end_date: false,
			form_data: {
				id_tipe_bangunan: '',
				id_sales: '',
				status_unit: '',
				nama_unit: '',
				alamat: '',
				kota: '',
				kecamatan: '',
				luas_tanah:'',
				luas_bangunan:'',
				kondisi_bangunan: '',
				lebar_jalan_depan: '',
				sertifikat: '',
				atas_nama: '',
		    	kelengkapan_surat: [],
		    	jumlah_kamar_tidur: '',
		    	jumlah_lantai:'',
		    	jumlah_kamar_mandi: '',
		    	jumlah_garasi_mobil: '',
		    	listrik: '',
		    	line_telepon: '',
		    	air: '',
		    	furniture_termasuk: [],
		    	deskripsi_unit: '',
		    	harga_unit: '',
		    	harga_per_meter: '',
		    	jenis_pembayaran: [],
		    	nama_pemilik: '',
		    	alamat_lengkap_pemilik: '',
		    	no_telepon_pemilik: '',
		    	no_npwp_pemilik: '',
		    	bersedia_dipasang: '',
		    	jangka_waktu_pemasangan: '',
		    	open_house: '',
		    	gallery_unit: [],
		    	approved_status: '',
		    	latitude: '',
		    	longitude: '',
		    	start_date_iklan: '',
		    	end_date_iklan: '',

			},
			field_state: false,
			form_alert_state: false,
			form_alert_color: '',
			form_alert_text: ''
		}),
		mounted() {
            this.getFormData();
        },
		methods: {
    		getFormData() {
    			if (this.dataUri) {
    				this.show_maps = false
    				this.field_state = true

    		        axios
    		            .get(this.dataUri)
    		            .then(response => {
    		            	if (response.data.success) {
    		            		let data = response.data.data
    		            		this.form_data = {
	            					id_tipe_bangunan: data.id_tipe_bangunan,
	            					id_sales: data.id_sales,
									status_unit: data.status_unit,
									nama_unit: data.nama_unit,
									alamat: data.alamat,
									provinsi: data.provinsi,
									kota: data.kota,
									kecamatan: data.kecamatan,
									luas_tanah: data.luas_tanah,
									luas_bangunan: data.luas_bangunan,
									kondisi_bangunan: data.kondisi_bangunan,
									lebar_jalan_depan: data.lebar_jalan_depan,
									sertifikat: data.sertifikat,
									atas_nama: data.atas_nama,
							    	kelengkapan_surat: data.kelengkapan_surat ? data.kelengkapan_surat : [],
							    	jumlah_kamar_tidur: data.jumlah_kamar_tidur,
							    	jumlah_lantai: data.jumlah_lantai,
							    	jumlah_kamar_mandi: data.jumlah_kamar_mandi,
							    	jumlah_garasi_mobil: data.jumlah_garasi_mobil,
							    	listrik: data.listrik,
							    	line_telepon: data.line_telepon,
							    	air: data.air,
							    	furniture_termasuk: data.furniture_termasuk ? data.furniture_termasuk : [],
							    	deskripsi_unit: data.deskripsi_unit,
							    	harga_unit: data.harga_unit,
							    	harga_per_meter: data.harga_per_meter,
							    	jenis_pembayaran: data.jenis_pembayaran,
							    	nama_pemilik: data.nama_pemilik,
							    	alamat_lengkap_pemilik: data.alamat_lengkap_pemilik,
							    	no_telepon_pemilik: data.no_telepon_pemilik,
							    	no_npwp_pemilik: data.no_npwp_pemilik,
							    	bersedia_dipasang: data.bersedia_dipasang,
							    	jangka_waktu_pemasangan: data.jangka_waktu_pemasangan,
							    	open_house: data.open_house,
							    	gallery_unit: JSON.parse(data.gallery_unit),
							    	approved_status : data.approved_status,
							    	for_status : data.nama_unit,
							    	latitude : data.latitude,
							    	longitude : data.longitude,
							    	start_date_iklan: data.start_date_iklan,
							    	end_date_iklan: data.end_date_iklan,

							    	url_gallery_unit: data.url_gallery_unit
    		            		}

    			                this.field_state = false
    		            	} else {
    		            		this.form_alert_state = true
		    		            this.form_alert_color = 'error'
		    		            this.form_alert_text = response.data.message
			    		        this.field_state = false
    		            	}
    		            	this.show_maps = true
    		            })
    		            .catch(error => {
		            		this.form_alert_state = true
	    		            this.form_alert_color = 'error'
	    		            this.form_alert_text = response.data.message
		    		        this.field_state = false
		    		        this.show_maps = true
    		            });
    			}
    		},
			clearForm() {
				this.form_data = {
					id_tipe_bangunan: '',
					id_sales: '',
					status_unit: '',
					nama_unit: '',
					alamat: '',
					kota: '',
					kecamatan: '',
					luas_tanah:'',
					luas_bangunan:'',
					kondisi_bangunan: '',
					lebar_jalan_depan: '',
					sertifikat: '',
					atas_nama: '',
			    	kelengkapan_surat: [],
			    	jumlah_kamar_tidur: '',
			    	jumlah_lantai:'',
			    	jumlah_kamar_mandi: '',
			    	jumlah_garasi_mobil: '',
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
			    	for_status: '',
			    	latitude: '',
			    	longitude: '',
			    	start_date_iklan: '',
			    	end_date_iklan: '',
				}
				this.$refs.observer.reset()
			},
	    	submitForm() {
				this.$refs.observer.validate().then((success) => {
					if (!success) {
			          	return;
			        }

			        this.field_state = true

			        this.postFormData()
				});
	    	},
		    postFormData() {
	    		const form_data = new FormData(this.$refs['post-form']);
	    		form_data.append("start_date_iklan", this.form_data.start_date_iklan ? this.form_data.start_date_iklan : '');
                form_data.append("end_date_iklan", this.form_data.end_date_iklan ? this.form_data.end_date_iklan : '');

	    		if (_.isEmpty(this.form_data.kelengkapan_surat)) {
		    		data.append("kelengkapan_surat[]", "");
	    		}
	    		if (_.isEmpty(this.form_data.furniture_termasuk)) {
		    		data.append("furniture_termasuk[]", "");
	    		}
	    		if (this.dataUri) {
	    		    form_data.append("_method", "put");
	    		}

	    		axios.post(this.actionForm, form_data)
	    		    .then((response) => {
	    		        if (response.data.success) {
	    		            this.form_alert_state = true
	    		            this.form_alert_color = 'success'
	    		            this.form_alert_text = response.data.message

	    		            setTimeout(() => {
			                    this.goto(this.redirectUri);
			                }, 6000);
	    		        } else {
		    		        this.field_state = false

	    		            this.form_alert_state = true
	    		            this.form_alert_color = 'error'
	    		            this.form_alert_text = response.data.message
	    		        }
	    		    })
	    		    .catch((error) => {
	    		        this.field_state = false
	    		        this.form_alert_state = true
	    		        this.form_alert_color = 'error'
	                    this.form_alert_text = 'Oops, something went wrong. Please try again later.'
	    		    });
		    },
		}
	}
</script>
<style>
#view-map {
	min-height: 400px;
	height: 100%;
}
</style>