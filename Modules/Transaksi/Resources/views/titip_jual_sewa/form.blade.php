<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Nama Pemilik" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.nama_pemilik"
                label="Nama Pemilik"
    			name="nama_pemilik"
	    		hint="* harus diisi"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
                :readonly="!field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider rules="required|max:15" name="Nomor handphone" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.telepone"
                label="Nomor Handphone"
                name="telepone"
                v-mask="'+62############'"
                placeholder="+62812800000000"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
                :readonly="!field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Tipe bangunan" rules="required">
            <v-autocomplete
                class="my-4"
                v-model="form_data.id_tipe_bangunan"
                label="Tipe Bangunan"
                name="id_tipe_bangunan"
                :items="filterTipeBangunan"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
                :readonly="!field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Kebutuhan" rules="required">
            <v-autocomplete
                class="my-4"
                v-model="form_data.kebutuhan"
                label="Kebutuhan"
                name="kebutuhan"
                :items="['Jual', 'Sewa']"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
                :readonly="!field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider rules="required" name="Provinsi" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.provinsi"
                label="Provinsi"
                name="provinsi"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
                :readonly="!field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider rules="required" name="Kota" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.kota"
                label="Kota"
                name="kota"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
                :readonly="!field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider rules="required" name="Alamat" v-slot="{ errors }">
            <v-textarea
                class="my-4"
                rows="3"
                v-model="form_data.alamat"
                label="Alamat"
                name="alamat"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
                :readonly="!field_state"
            ></v-textarea>
        </validation-provider>

        <h3  class="mt-4">Sertifikat :</h3>
        <v-row>
            <v-col cols="12" md="2">
                <v-checkbox
                    v-model="form_data.sertifikat"
                    label="HGB"
                    value="HGB"
                    name="sertifikat[]"
                ></v-checkbox>
            </v-col>
            <v-col cols="12" md="2">
                <v-checkbox
                    v-model="form_data.sertifikat"
                    label="SHM"
                    value="SHM"
                    name="sertifikat[]"
                ></v-checkbox>
            </v-col>
            <v-col cols="12" md="2">
                <v-checkbox
                    v-model="form_data.sertifikat"
                    label="Strata"
                    value="Strata"
                    name="sertifikat[]"
                ></v-checkbox>
            </v-col>
            <v-col cols="12" md="2">
                <v-checkbox
                    v-model="form_data.sertifikat"
                    label="Lainya"
                    value="Lainya"
                    name="sertifikat[]"
                ></v-checkbox>
            </v-col>
        </v-row>

        <h3  class="mt-4">Gallery Unit :</h3>
        <v-row>
            <v-col
                v-for="(el, idx) in form_data.url_gallery_unit"
                cols="12"
                md="3"
            >
                <a :href="el" target="_blank">
                    <v-card
                        class="mx-auto"
                        min-height="150"
                        max-height="150"
                        max-width="250"
                        tile
                    >
                        <v-img
                            max-height="150"
                            max-width="250"
                            :src="el"
                        ></v-img>
                    </v-card>
                    
                </a>
            </v-col>
        </v-row>
        <validation-provider v-slot="{ errors }" name="" rules="">
            <v-autocomplete
                class="my-4"
                v-model="form_data.status"
                label="Status"
                name="status"
                :items="['Terjual','Pending']"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

        <v-btn
        	class="mr-4 mt-5"
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
            class="mt-5"
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