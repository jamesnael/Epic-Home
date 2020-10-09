<script type="text/javascript">
	import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate';
	import { required, email, numeric, image , regex, max} from 'vee-validate/dist/rules'
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
			filterTipeProyek: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterTipeBangunan: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterDeveloper: {
			    type: Array,
			    default: function () {
			        return []
			    }
			}
		},
		data: () => ({
			form_data: {
				fasilitas_umum: [],
		    	id_tipe_bangunan: '',
				id_tipe_proyek: '',
		    	status_unit: '',
		    	nama_proyek: '',
		    	provinsi: '',
		    	kota: '',
		    	kabupaten: '',
		    	alamat: '',
		    	longitude: '',
		    	latitude: '',
		    	google_map_gallery: [],
		    	harga_awal: '',
		    	nup: '',
		    	utj: '',
		    	komisi: '',
		    	closing_fee: '',
		    	reward: '',
		    	jenis_pembayaran: '',
		    	tahun_selesai: '',
		    	estimasi_selesai: '',
		    	lingkungan_sekitar: '',
		    	jumlah_tower: '',
		    	sertifikat: [],
		    	fasilitas: [],
		    	profile_proyek: '',
		    	id_developer: '',
		    	nama_pic: '',
		    	nomor_handphone: '',
		    	copywriting: '',
		    	broadcast_message: '',
		    	question_answer: '',
		    	banner_proyek: '',
		    	progress_update: [],
		    	product_knowledge: '',

			},
			field_state: false,
			form_alert_state: false,
			form_alert_color: '',
			form_alert_text: ''
		}),
		mounted() {
            this.getFormData();
            // this.checkGoogleInit();
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

    		            		console.log(data.progress_update)
		            			
    		            		this.form_data = {
    		            			fasilitas_umum:[],
	            			    	id_tipe_bangunan: data.id_tipe_bangunan,
	            					id_tipe_proyek: data.id_tipe_proyek,
	            			    	status_unit: data.status_unit,
	            			    	nama_proyek: data.nama_proyek,
	            			    	provinsi: data.provinsi,
	            			    	kota: data.kota,
	            			    	kabupaten: data.kabupaten,
	            			    	alamat: data.alamat,
	            			    	longitude: data.longitude,
	            			    	latitude: data.latitude,
	            			    	google_map_gallery: JSON.parse(data.google_map_gallery),
	            			    	harga_awal: data.harga_awal,
	            			    	nup: data.nup,
	            			    	utj: data.utj,
	            			    	komisi: data.komisi,
	            			    	closing_fee: data.closing_fee,
	            			    	reward: data.reward,
	            			    	jenis_pembayaran: data.jenis_pembayaran,
	            			    	tahun_selesai: data.tahun_selesai,
	            			    	estimasi_selesai: data.estimasi_selesai,
	            			    	lingkungan_sekitar: data.lingkungan_sekitar,
	            			    	jumlah_tower: data.jumlah_tower,
	            			    	sertifikat: data.sertifikat,
	            			    	fasilitas: data.fasilitas,
	            			    	profile_proyek: data.profile_proyek,
	            			    	id_developer: data.id_developer,
	            			    	nama_pic: data.nama_pic,
	            			    	nomor_handphone: data.nomor_handphone,
	            			    	copywriting: data.copywriting,
	            			    	broadcast_message: data.broadcast_message,
	            			    	question_answer: data.question_answer,
	            			    	banner_proyek: data.banner_proyek,
	            			    	progress_update: JSON.parse(data.progress_update),
	            			    	product_knowledge: data.product_knowledge,

	            			    	url_banner_proyek: data.url_banner_proyek,
	            			    	url_product_knowledge: data.url_product_knowledge,
	            			    	url_progress_update: data.url_progress_update,
	            			    	url_google_map_gallery: data.url_google_map_gallery,
    		            		},

    		            		_.forEach(data.detail_fasilitas, (value) => {
		            			  	this.form_data.fasilitas_umum.push({
		            			  		nama_fasilitas_umum: value.nama_fasilitas_umum,
			  							detail_fasilitas_umum: value.detail_fasilitas_umum,
			  							jarak: value.jarak,
			  							id_proyek_primary: value.id_proyek_primary,
			  							id: value.id,
		            			  	})
		            			});

    		            		

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
					fasilitas_umum: [],
			    	id_tipe_bangunan: '',
					id_tipe_proyek: '',
			    	status_unit: '',
			    	nama_proyek: '',
			    	provinsi: '',
			    	kota: '',
			    	kabupaten: '',
			    	alamat: '',
			    	longitude: '',
			    	latitude: '',
			    	google_map_gallery: '',
			    	harga_awal: '',
			    	nup: '',
			    	utj: '',
			    	komisi: '',
			    	closing_fee: '',
			    	reward: '',
			    	jenis_pembayaran: '',
			    	tahun_selesai: '',
			    	estimasi_selesai: '',
			    	lingkungan_sekitar: '',
			    	jumlah_tower: '',
			    	sertifikat: '',
			    	fasilitas: '',
			    	profile_proyek: '',
			    	id_developer: '',
			    	nama_pic: '',
			    	nomor_handphone: '',
			    	copywriting: '',
			    	broadcast_message: '',
			    	question_answer: '',
			    	banner_proyek: '',
			    	progress_update: '',
			    	product_knowledge: '',
					
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
	    		form_data.append("fasilitas_umum", this.form_data.fasilitas_umum ? JSON.stringify(this.form_data.fasilitas_umum) : [] )
	    		form_data.append("profile_proyek", this.form_data.profile_proyek)
	    		form_data.append("broadcast_message", this.form_data.broadcast_message)
	    		form_data.append("question_answer", this.form_data.question_answer)
	    		
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
		    addFasilitasUmum() {
		    	this.form_data.fasilitas_umum.push({
					nama_fasilitas_umum: '',
					detail_fasilitas_umum: '',
					jarak: ''
				})
		    },
		    removeFasilitasUmum(idx) {
		    	this.form_data.fasilitas_umum = _.filter(this.form_data.fasilitas_umum, (el, key) => {
		    		return key != idx
		    	})
		    },
		    checkGoogleInit() {
				var self = this;
				setTimeout(function() {
		            if(typeof google === 'undefined') {
		                self.checkGoogleInit();
		            } else {
		                self.GMapsProyekPrimaryInit();
		            }
		        }, 500);
        	},
        	GMapsProyekPrimaryInit() {
        		if (this.form_data.project_address_latitude && this.form_data.project_address_longitude) {
	                var map = new google.maps.Map(document.getElementById('proyek-primary-map'), {
			          	center: {lat: parseFloat(this.form_data.project_address_latitude), lng: parseFloat(this.form_data.project_address_longitude)},
			          	zoom: 14
			        });

                    var marker = new google.maps.Marker({
    	                position: {lat: parseFloat(this.form_data.project_address_latitude), lng: parseFloat(this.form_data.project_address_longitude)},
    	                map: map
    	            });
    	            map.panTo({lat: parseFloat(this.form_data.project_address_latitude), lng: parseFloat(this.form_data.project_address_longitude)});
        		} else {
	                var map = new google.maps.Map(document.getElementById('proyek-primary-map'), {
			          	center: {lat: -6.1767287, lng: 106.829541},
			          	zoom: 14
			        });

			        var marker
        		}


		        map.addListener('click', (mapsMouseEvent) => {
		            this.form_data.project_address_latitude = mapsMouseEvent.latLng.lat()
		            this.form_data.project_address_longitude = mapsMouseEvent.latLng.lng()
		            if (marker) {
			            marker.setMap(null)
		            }
		            marker = new google.maps.Marker({
		                position: mapsMouseEvent.latLng,
		                map: map
		            });
		            map.panTo(mapsMouseEvent.latLng);
		        });
        	},
		}
	}
</script>
<style>
#office-map, #proyek-primary-map {
	min-height: 400px;
	height: 100%;
}
</style>