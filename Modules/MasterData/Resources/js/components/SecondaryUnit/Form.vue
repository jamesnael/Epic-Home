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
		},
		data: () => ({
			form_data: {
				id_tipe_bangunan: '',
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
		    	gallery_unit: [],
		    	approved_status: ''

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
    				this.field_state = true

    		        axios
    		            .get(this.dataUri)
    		            .then(response => {
    		            	if (response.data.success) {
    		            		let data = response.data.data
    		            		this.form_data = {
	            					id_tipe_bangunan: data.id_tipe_bangunan,
									status_unit: data.status_unit,
									nama_unit: data.nama_unit,
									alamat: data.alamat,
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
							    	jumlah_garasi: data.jumlah_garasi,
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

							    	url_gallery_unit: data.url_gallery_unit
    		            		}

    			                this.field_state = false
    		            	} else {
    		            		this.form_alert_state = true
		    		            this.form_alert_color = 'error'
		    		            this.form_alert_text = response.data.message
			    		        this.field_state = false
    		            	}
    		            })
    		            .catch(error => {
		            		this.form_alert_state = true
	    		            this.form_alert_color = 'error'
	    		            this.form_alert_text = response.data.message
		    		        this.field_state = false
    		            });
    			}
    		},
			clearForm() {
				this.form_data = {
					id_tipe_bangunan: '',
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
			    	for_status: '',
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
		    }
		}
	}
</script>