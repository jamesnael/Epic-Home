<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Nama sales" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.nama_sales"
                label="Nama Sales"
    			name="nama_sales"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* harus diisi"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required|max:15" name="No handphone" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.no_telepon"
                label="No handphone"
                name="no_telepon"
                v-mask="'+62############'"
                placeholder="+62817800000000"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
    
        <validation-provider rules="required|max:15" name="No handphone (agen referensi)" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.no_telepon_agent_referensi"
                label="No Handphone (Agen Referensi)"
                name="no_telepon_agent_referensi"
                v-mask="'+62############'"
                placeholder="+62817800000000"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

         <validation-provider v-slot="{ errors }" name="Tipe Agen" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.tipe_agent" 
                :items="['Independen','Kantor Properti']"
                label="Tipe Agen"
                name="tipe_agent"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>


        <validation-provider rules="required" name="Kantor agen" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.kantor_agent"
                label="Kantor Agen"
                name="kantor_agent"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

         <h3  class="mt-4">Data Diri :</h3>

        <validation-provider rules="required" name="Email" v-slot="{ errors }">
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

        <validation-provider rules="required" name="Nama depan" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.nama_depan"
                label="Nama Depan"
                name="nama_depan"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Nama belakang" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.nama_belakang"
                label="Nama Belakang"
                name="nama_belakang"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Jenis kelamin" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.jenis_kelamin" 
                :items="['Laki-laki','Perempuan']"
                label="Jenis Kelamin"
                name="jenis_kelamin"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

          <validation-provider rules="required" name="Tempat lahir" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.tempat_lahir"
                label="Tempat Lahir"
                name="tempat_lahir"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="" rules="">
                    <v-menu
                        v-model="menu3"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        transition="scale-transition"
                        offset-y
                        min-width="290px"
                      >
                        <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            class="mt-4"
                            :value="reformatDateTime(form_data.tanggal_lahir, 'YYYY-MM-DD', 'DD MMMM YYYY')"
                            label="Tanggal Lahir"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                            :persistent-hint="true"
                            :error-messages="errors"
                            :readonly="!field_state"
                            :disabled="field_state">
                        </v-text-field>
                        </template>
                        <v-date-picker name="tanggal_lahir" v-model="form_data.tanggal_lahir" @input="menu3 = false" :disabled="field_state"></v-date-picker>
                    </v-menu>
                </validation-provider>

        <v-textarea
            class="my-4"
            v-model="form_data.alamat"
            name="alamat"
            label="Alamat Lengkap"
            auto-grow
            clearable
            rows="3"
            clear-icon="mdi-eraser-variant"
            :disabled="field_state">
        </v-textarea>

        <validation-provider rules="required" name="No rekening" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.no_rekening"
                label="No Rekening"
                name="no_rekening"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Atas nama" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.nama_rekening"
                label="Atas Nama"
                name="nama_rekening"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
	
        <validation-provider rules="required" name="Bank/cabang" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.bank"
                label="Bank/cabang"
                name="bank"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="No.npwp" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.no_npwp"
                label="No. NPWP"
                name="no_npwp"
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
			v-model="form_data.note"
			name="note"
    		label="Note"
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
                name="foto_ktp"
                label="Foto KTP"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
            <a :href="form_data.url_foto_ktp" target="_blank" class="ml-8">
                <small>@{{form_data.foto_ktp}}</small>
            </a>
        </div>

         <div  class="mb-4">
            <v-file-input
                small-chips
                multiple
                accept="image/*"
                name="foto_selfie"
                label="Foto Selfie"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
            <a :href="form_data.url_foto_selfie" target="_blank" class="ml-8">
                <small>@{{form_data.foto_selfie}}</small>
            </a>
        </div>

        <validation-provider v-slot="{ errors }" name="Status Sales" rules="">
             <v-autocomplete
                class="my-4"
                v-model="form_data.status_sales" 
                :items="['Verifikasi','Ulang','Sukses']"
                label="Status Sales"
                name="status_sales"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

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