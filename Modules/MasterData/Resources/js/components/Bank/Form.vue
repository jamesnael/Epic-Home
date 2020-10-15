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
			filterStatus: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterJenisBank: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
		},
		data: () => ({
			enabled: false,
			form_data: {
				nama_bank: '',
				jenis_bank: '',
				nama_pinjaman: '',
				suku_bunga: '',
				masa_kredit: '',
				tenor_mulai_dari: '',
				tenor_sampai_dengan:'',
				status:'',
				flat_suku_bunga:false
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
    		            			nama_bank: data.nama_bank,
    		            			jenis_bank: data.jenis_bank,
    		            			nama_pinjaman: data.nama_pinjaman,
    		            			suku_bunga: data.suku_bunga,
    		            			masa_kredit: data.masa_kredit,
    		            			tenor_mulai_dari: data.tenor_mulai_dari,
    		            			tenor_sampai_dengan: data.tenor_sampai_dengan,
    		            			status: data.status,
    		            			flat_suku_bunga: data.flat_suku_bunga,
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
					nama_bank: '',
					jenis_bank: '',
					nama_pinjaman: '',
					suku_bunga: '',
					masa_kredit: '',
					tenor_mulai_dari: '',
					tenor_sampai_dengan:'',
					status: '',
					flat_suku_bunga:false
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