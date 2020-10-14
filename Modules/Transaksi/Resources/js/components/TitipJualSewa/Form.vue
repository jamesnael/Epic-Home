<script type="text/javascript">
	import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate';
	import { required, min, max, image } from 'vee-validate/dist/rules'
	import id from 'vee-validate/dist/locale/id.json'

	extend('required', required)
	extend('min', min)
	extend('max', max)
	extend('image', image)
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
		},
		data: () => ({
			search_tag: null,
			menu1: false,
			form_data: {
				id_tipe_bangunan:'',
		    	nama_pemilik:'',
		    	telepone:'',
		    	kebutuhan:'',
		    	provinsi:'',
		    	kota:'',
		    	kabupaten:'',
		    	kecamatan:'',
		    	alamat:'',
		    	sertifikat:[],
		    	gallery_unit:[],
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
    		            			id_tipe_bangunan:data.id_tipe_bangunan,
    						    	nama_pemilik:data.nama_pemilik,
    						    	telepone:data.telepone,
    						    	kebutuhan:data.kebutuhan,
    						    	provinsi:data.provinsi,
    						    	kota:data.kota,
    						    	kabupaten:data.kabupaten,
    						    	kecamatan:data.kecamatan,
    						    	alamat:data.alamat,
    						    	sertifikat:data.sertifikat,
    						    	gallery_unit:data.gallery_unit,
    						    	url_gallery_unit:data.url_gallery_unit,
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
					id_tipe_bangunan:'',
			    	nama_pemilik:'',
			    	telepone:'',
			    	kebutuhan:'',
			    	provinsi:'',
			    	kota:'',
			    	kabupaten:'',
			    	kecamatan:'',
			    	alamat:'',
			    	sertifikat:'',
			    	gallery_unit:'',
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