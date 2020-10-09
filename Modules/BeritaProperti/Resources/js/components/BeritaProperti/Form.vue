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
			filterTag: {
			    type: Array,
			    default: function () {
			        return []
			    }
			},
			filterPublish: {
			    type: Array,
			    default: function () {
			        return []
			    }
			}
		},
		data: () => ({
			search_tag: null,
			menu1: false,
			form_data: {
				judul: '',
				tag: '',
				deskripsi: '',
				thumbnail: '',
				banner: '',
				konten: '',
				penulis: '',
				publish: '',
				publish_date: new Date().toISOString().substr(0, 10)
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
    		            			judul: data.judul,
    		            			tag: data.tag,
    		            			deskripsi: data.deskripsi,
    		            			thumbnail: data.thumbnail,
    		            			banner: data.deskripsi,
    		            			konten: data.konten,
    		            			penulis: data.penulis,
    		            			publish: data.publish,
    		            			publish_date: data.publish_date,
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
					judul: '',
					tag: '',
					deskripsi: '',
					thumbnail: '',
					banner: '',
					konten: '',
					penulis: '',
					publish: '',
					publish_date: ''
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
	    		    form_data.append("publish_date", this.form_data.publish_date);
                    form_data.append("konten", this.form_data.konten)
	    		}
	    		
	    		form_data.append("publish_date", this.form_data.publish_date);
	    		form_data.append("konten", this.form_data.konten)

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