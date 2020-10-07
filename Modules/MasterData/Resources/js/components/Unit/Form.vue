<script type="text/javascript">
	import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate';
	import { required, numeric } from 'vee-validate/dist/rules'
	import id from 'vee-validate/dist/locale/id.json'

	extend('required', required)
	extend('numeric', numeric)
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
			filterProyekPrimari: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterTipeUnit: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterCluster: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
		},
		data: () => ({
			form_data: {
				id_proyek_primari: '',
				id_cluster: '',
				tipe_unit: '',
				harga_unit: '',
				harga_per_meter: '',
				blok: '',
				nomor_unit: '',
				luas_tanah: '',
				luas_bangunan: '',
				arah_bangunan: '',
				jumlah_kamar_tidur: '',
				jumlah_kamar_mandi: '',
				jumlah_lantai: '',
				jumlah_garasi_mobil: '',
				listrik: '',
				lebar_jalan_depan: '',
				lingkungan_sekitar: '',
				gambar_unit: ''
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
    		            			id_proyek_primari: data.id_proyek_primari,
									id_cluster: data.id_cluster,
									tipe_unit: data.tipe_unit,
									harga_unit: data.harga_unit,
									harga_per_meter: data.harga_per_meter,
									blok: data.blok,
									nomor_unit: data.nomor_unit,
									luas_tanah: data.luas_tanah,
									luas_bangunan: data.luas_bangunan,
									arah_bangunan: data.arah_bangunan,
									jumlah_kamar_tidur: data.jumlah_kamar_tidur,
									jumlah_kamar_mandi: data.jumlah_kamar_mandi,
									jumlah_lantai: data.jumlah_lantai,
									jumlah_garasi_mobil: data.jumlah_garasi_mobil,
									listrik: data.listrik,
									lebar_jalan_depan: data.lebar_jalan_depan,
									lingkungan_sekitar: data.lingkungan_sekitar,
									gambar_unit: data.gambar_unit
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
					id_proyek_primari: '',
					id_cluster: '',
					tipe_unit: '',
					harga_unit: '',
					harga_per_meter: '',
					blok: '',
					nomor_unit: '',
					luas_tanah: '',
					luas_bangunan: '',
					arah_bangunan: '',
					jumlah_kamar_tidur: '',
					jumlah_kamar_mandi: '',
					jumlah_lantai: '',
					jumlah_garasi_mobil: '',
					listrik: '',
					lebar_jalan_depan: '',
					lingkungan_sekitar: '',
					gambar_unit: ''
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