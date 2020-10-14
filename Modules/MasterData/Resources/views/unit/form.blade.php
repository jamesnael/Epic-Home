<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider v-slot="{ errors }" name="Nama Proyek" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="idProyekPrimary" 
                :items="filterProyekPrimari"
                label="Nama Proyek"
                name="id_proyek_primari"
                hint="* harus diisi"
                readonly
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Cluster" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.id_cluster" 
                :items="filterCluster"
                label="Cluster"
                name="id_cluster"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Tipe Unit" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.id_tipe_unit" 
                :items="filterTipeUnit"
                label="Tipe Unit"
                name="id_tipe_unit"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="No.Blok" rules="required">
            <v-text-field
                class="my-4"
                v-model="form_data.blok"
                label="No.Blok"
                name="blok"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="No.Unit" rules="required">
            <v-text-field
                class="my-4"
                v-model="form_data.nomor_unit"
                label="No.Unit"
                name="nomor_unit"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Harga Unit" rules="required|numeric|min:0">
            <v-text-field
                class="mt-4"
                v-model="form_data.harga_unit"
                label="Harga Unit"
                name="harga_unit"
                clearable
                hide-details
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
            <small class="form-text text-muted">Rp @{{ form_data.harga_unit ? number_format(form_data.harga_unit) : 0 }}</small>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Harga Per Meter" rules="required|numeric|min:0">
            <v-text-field
                class="mt-4"
                v-model="form_data.harga_per_meter"
                label="Harga Per Meter"
                name="harga_per_meter"
                clearable
                hide-details
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
            <small class="form-text text-muted">Rp @{{ form_data.harga_per_meter ? number_format(form_data.harga_per_meter) : 0 }}</small>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Luas Tanah" rules="required|numeric|min:0">
            <v-text-field
                class="my-4"
                v-model="form_data.luas_tanah"
                label="Luas Tanah"
                name="luas_tanah"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            >
                <span slot="append">m<sup>2</sup></span>
            </v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Luas Bangunan" rules="required|numeric|min:0">
            <v-text-field
                class="my-4"
                v-model="form_data.luas_bangunan"
                label="Luas Bangunan"
                name="luas_bangunan"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            >
                <span slot="append">m<sup>2</sup></span>
            </v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Arah Bangunan" rules="required">
            <v-text-field
                class="my-4"
                v-model="form_data.arah_bangunan"
                label="Arah Bangunan"
                name="arah_bangunan"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Jumlah Kamar Tidur" rules="required|numeric|min:0">
            <v-text-field
                class="my-4"
                v-model="form_data.jumlah_kamar_tidur"
                label="Jumlah Kamar Tidur"
                name="jumlah_kamar_tidur"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Jumlah Kamar Mandi" rules="required|numeric|min:0">
            <v-text-field
                class="my-4"
                v-model="form_data.jumlah_kamar_mandi"
                label="Jumlah Kamar Mandi"
                name="jumlah_kamar_mandi"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Jumlah Lantai" rules="required|numeric|min:0">
            <v-text-field
                class="my-4"
                v-model="form_data.jumlah_lantai"
                label="Jumlah Lantai"
                name="jumlah_lantai"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Jumlah Garasi Mobil" rules="required|numeric|min:0">
            <v-text-field
                class="my-4"
                v-model="form_data.jumlah_garasi_mobil"
                label="Jumlah Garasi Mobil"
                name="jumlah_garasi_mobil"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Listrik" rules="required|numeric|min:0">
            <v-text-field
                class="my-4"
                v-model="form_data.listrik"
                label="Listrik"
                name="listrik"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            >
                <span slot="append">Watt</span>
            </v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Lebar Jalan Depan" rules="required|numeric|min:0">
            <v-text-field
                class="my-4"
                v-model="form_data.lebar_jalan_depan"
                label="Lebar Jalan Depan"
                name="lebar_jalan_depan"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Lingkungan Sekitar" rules="required">
            <v-text-field
                class="my-4"
                v-model="form_data.lingkungan_sekitar"
                label="Lingkungan Sekitar"
                name="lingkungan_sekitar"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Gambar Unit" rules="image">
            <v-file-input
                class="my-4"
                accept="image/*"
                prepend-icon="mdi-camera"
                hint="hanya menerima file dalam format image"
                :persistent-hint="true"
                show-size
                label="Gambar Unit"
                name="gambar_unit[]"
                multiple
            ></v-file-input>
            <v-row class="mb-3">
                <v-col
                    v-for="(el, idx) in form_data.url_gambar_unit"
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