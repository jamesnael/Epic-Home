<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Nama kantor developer" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.nama_developer"
                label="Nama Kantor Developer"
    			name="nama_developer"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* harus diisi"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required|email" name="Email" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.email"
                label="Email"
                name="email"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
    
        <validation-provider rules="numeric" name="Nomor telepon" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.nomor_telepon"
                label="Nomor Telepon"
                name="nomor_telepon"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <v-textarea
            class="my-4"
            v-model="form_data.alamat"
            name="alamat"
            label="Alamat"
            auto-grow
            clearable
            rows="3"
            clear-icon="mdi-eraser-variant"
            :disabled="field_state">
        </v-textarea>

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
        
        <div  class="mb-4">
            <v-file-input
                small-chips
                multiple
                accept="image/*"
                name="logo_developer"
                label="Logo"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
            <a :href="form_data.url_logo_developer" target="_blank" class="ml-8">
                <small>@{{form_data.logo_developer}}</small>
            </a>
        </div>

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