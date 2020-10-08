<script type="text/javascript">
	import { ValidationObserver, ValidationProvider, extend, localize } from 'vee-validate';
	import { required, email, numeric } from 'vee-validate/dist/rules'
	import id from 'vee-validate/dist/locale/id.json'

	extend('required', required)
	extend('email', email)
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
			},
			field_state: false,
			form_alert_state: false,
			form_alert_color: '',
			form_alert_text: ''
		}),
		mounted() {
            this.getFormData();
            this.checkGoogleInit();
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