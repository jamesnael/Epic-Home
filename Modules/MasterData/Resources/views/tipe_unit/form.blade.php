<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider v-slot="{ errors }" name="Tipe proyek" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.id_tipe_proyek" 
                :items="filterTipeProyek"
                label="Tipe Proyek"
                name="id_tipe_proyek"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider rules="required" name="Tipe unit" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.nama_tipe_unit"
                label="Tipe Unit"
    			name="nama_tipe_unit"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* harus diisi"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

		<v-textarea
			class="my-4"
			v-model="form_data.deskripsi"
			name="deskripsi"
    		label="Deskripsi"
    		auto-grow
			clearable
			rows="3"
	      	clear-icon="mdi-eraser-variant"
    		:disabled="field_state">
		</v-textarea>

        <v-btn
        	class="mr-4"
          	:loading="field_state"
          	:disabled="field_state"
            color="primary"
            @click="submitForm"
        >
            simpan
            <template v-slot:loader>
                <span class="custom-loader">
                  	<v-icon light>mdi-cached</v-icon>
                </span>
            </template>
        </v-btn>
        <v-btn
	        type="button"
	        @click="clearForm"
	        :disabled="field_state"
	    >
            hapus
        </v-btn>
    </form>

    <v-snackbar
        v-model="form_alert_state"
        top
        multi-line
        :color="form_alert_color"
        elevation="5"
        timeout="6000"
    >
    	@{{ form_alert_text }}
    </v-snackbar>
</validation-observer>