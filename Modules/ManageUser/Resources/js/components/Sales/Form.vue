<script type="text/javascript">
	import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate';
	import { required, email, numeric, image , regex, max } from 'vee-validate/dist/rules'
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
			filterJenisKelamin: {
				type: Array,
				required: true
			},
			filterTipeAgent: {
				type: Array,
				required: true
			},
			filterStatusSales: {
				type: Array,
				required: true
			}
		},
		data: () => ({
			menu3: false,
			showPassword: false,
			form_data: {
				nama:'',
		    	telepon:'',
		    	no_telepon_agent_referensi:'',
		    	tipe_agent:'',
		    	kantor_agent:'',
		    	email:'',
		    	nama_depan:'',
		    	nama_belakang:'',
		    	jenis_kelamin:'',
		    	tempat_lahir:'',
		    	tanggal_lahir:'',
		    	alamat:'',
		    	no_rekening:'',
		    	nama_rekening:'',
		    	bank:'',
		    	no_npwp:'',
		    	note:'',
		    	foto_ktp:'',
		    	foto_selfie:'',
		    	status_sales:''
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
    		            		console.log(response.data.message)
    		            		this.form_data = {
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
							    	no_rekening:data.sales.no_rekening,
							    	nama_rekening:data.sales.nama_rekening,
							    	bank: data.sales.bank,
							    	no_npwp: data.sales.no_npwp,
							    	note: data.sales.note,
							    	foto_ktp: data.sales.foto_ktp,
							    	foto_selfie: data.sales.foto_selfie,
							    	status_sales: data.sales.status_sales,
							    	url_foto_ktp: data.sales.url_foto_ktp,
							    	url_foto_selfie: data.sales.url_foto_selfie,
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
					nama:'',
			    	telepon:'',
			    	no_telepon_agent_referensi:'',
			    	tipe_agent:'',
			    	kantor_agent:'',
			    	email:'',
			    	nama_depan:'',
			    	nama_belakang:'',
			    	jenis_kelamin:'',
			    	tempat_lahir:'',
			    	tanggal_lahir:'',
			    	alamat:'',
			    	no_rekening:'',
			    	nama_rekening:'',
			    	bank:'',
			    	no_npwp:'',
			    	note:'',
			    	foto_ktp:'',
			    	foto_selfie:'',
			    	status_sales:''
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
    		    form_data.append("tanggal_lahir", this.form_data.tanggal_lahir ? this.form_data.tanggal_lahir : '');
	    		
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