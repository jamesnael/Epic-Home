<script type="text/javascript">
	import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate';
	import { required, min, max, numeric } from 'vee-validate/dist/rules'
	import id from 'vee-validate/dist/locale/id.json'

	extend('required', required)
	extend('min', min)
	extend('max', max)
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
			redirectPrimary: {
				type: String,
				required: true
			},
			redirectSecondary: {
				type: String,
				required: true
			},
			dataUri: {
				type: String,
				default: ''
			},
		},
		data: () => ({
			search_tag: null,
			menu1: false,
			form_data: {
				perihal_pembayaran:'',
				jumlah_bayar:'',
				terbilang:'',
				keterangan:'',
		        status:'',
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
    		            			id_unit: data.unit.id,
    		            			id_klien: data.klien.id,
    		            			proyek_primary: data.unit.proyek_primary ? data.unit.proyek_primary.id : '',
    		            			tanggal_pemesanan: data.created_at,
    		            			nama_proyek: data.unit.proyek_primary ? data.unit.proyek_primary.nama_proyek : '',
    		            			tipe_unit: data.unit.tipe_unit ? data.unit.tipe_unit.nama_tipe_unit : '',
    		            			harga_unit: data.unit.harga_unit,
    		            			cara_bayar: data.cara_bayar,
    		            			klien: data.klien.nama_klien,
    		            			telepon: data.klien.telepone,
    		            			nama_sales: data.unit.sales.user.nama,
    		            			nama_agent: '',

    		            			perihal_pembayaran: data.perihal_pembayaran,
        							jumlah_bayar: data.jumlah_bayar,
        							terbilang: data.terbilang,
        							keterangan: data.keterangan,
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
					perihal_pembayaran:'',
					jumlah_bayar:'',
					terbilang:'',
					keterangan:'',
			        status:'',
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
	    		            	if (this.form_data.proyek_primary) {
				                    this.goto(this.redirectPrimary);
	    		            	} else {
				                    this.goto(this.redirectSecondary);
	    		            	}
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