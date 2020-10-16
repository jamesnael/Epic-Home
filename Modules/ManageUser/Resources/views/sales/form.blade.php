<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Nama sales" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.nama"
                label="Nama Sales"
    			name="nama"
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
                v-model="form_data.telepon"
                label="No handphone"
                name="telepon"
                v-mask="'+##############'"
                placeholder="+62812411111111"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
    
        <validation-provider rules="max:15" name="No handphone (agen referensi)" v-slot="{ errors }">
            <v-text-field
                class="mt-4"
                v-model="form_data.no_telepon_agent_referensi"
                label="No Handphone (Agen Referensi)"
                name="no_telepon_agent_referensi"
                v-mask="'+##############'"
                placeholder="+62812411111111"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

         <validation-provider v-slot="{ errors }" name="Tipe Agen" vid="tipe_agent" rules="">
            <v-autocomplete
                class="mt-4"
                v-model="form_data.tipe_agent" 
                :items="filterTipeAgent"
                label="Tipe Agen"
                name="tipe_agent"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

         <validation-provider v-slot="{ errors }" name="Kantor agen" rules="required_if:tipe_agent,Agent Property">
            <v-autocomplete
                class="mt-4"
                :items="filterKantorAgent"
                v-model="form_data.kantor_agent"
                label="Kantor Agen"
                name="kantor_agent"
                item-value="id"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            >
                <template v-slot:selection="data">
                    <template>
                        <v-list-item-avatar>
                            <img :src="data.item.logo_agent">
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title v-html="data.item.nama_agent_property"></v-list-item-title>
                        </v-list-item-content>
                    </template>
                </template>
                <template v-slot:item="data">
                    <template>
                        <v-list-item-avatar>
                            <img :src="data.item.logo_agent">
                        </v-list-item-avatar>
                        <v-list-item-content>
                            <v-list-item-title v-html="data.item.nama_agent_property"></v-list-item-title>
                            <v-list-item-subtitle v-html="data.item.alamat"></v-list-item-subtitle>
                        </v-list-item-content>
                    </template>
                </template>
            </v-autocomplete>
        </validation-provider>

        <h3  class="mt-4">Data Diri :</h3>

        <validation-provider rules="email" name="Email" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.email"
                label="Email"
                name="email"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        {{-- <validation-provider rules="required" name="Nama depan" v-slot="{ errors }">
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
        </validation-provider> --}}

        <validation-provider v-slot="{ errors }" name="Jenis kelamin" rules="">
             <v-autocomplete
                class="my-4"
                v-model="form_data.jenis_kelamin" 
                :items="filterJenisKelamin"
                label="Jenis Kelamin"
                name="jenis_kelamin"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

        <validation-provider rules="" name="Tempat lahir" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.tempat_lahir"
                label="Tempat Lahir"
                name="tempat_lahir"
                clearable
                clear-icon="mdi-eraser-variant"
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

        <validation-provider rules="" name="No rekening" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.no_rekening"
                label="No Rekening"
                name="no_rekening"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="" name="Atas nama" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.nama_rekening"
                label="Atas Nama"
                name="nama_rekening"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
	
        <validation-provider rules="" name="Bank/cabang" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.bank"
                label="Bank/cabang"
                name="bank"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="" name="No.npwp" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.no_npwp"
                label="No. NPWP"
                name="no_npwp"
                clearable
                clear-icon="mdi-eraser-variant"
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
            <a :href="form_data.url_foto_ktp" target="_blank">
                <v-card
                    align="left"
                    v-if="form_data.url_foto_ktp"
                    max-width="250"
                    tile
                >
                    <v-img
                        max-height="150"
                        max-width="250"
                        :src="form_data.url_foto_ktp"
                    ></v-img>
                </v-card>
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
            <a :href="form_data.url_foto_selfie" target="_blank">
                <v-card
                    align="left"
                    v-if="form_data.url_foto_selfie"
                    max-width="250"
                    tile
                >
                    <v-img
                        max-height="150"
                        max-width="250"
                        :src="form_data.url_foto_selfie"
                    ></v-img>
                </v-card>
            </a>
        </div>

        <validation-provider v-slot="{ errors }" name="Status Sales" rules="">
             <v-autocomplete
                class="my-4"
                v-model="form_data.status_sales" 
                :items="filterStatusSales"
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