<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
       <validation-provider v-slot="{ errors }" name="Tipe bangunan" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.id_tipe_bangunan" 
                :items="filterTipeBangunan"
                label="Tipe Bangunan"
                name="id_tipe_bangunan"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

         <validation-provider v-slot="{ errors }" name="Nama Sales" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.id_sales" 
                :items="filterNamaSales"
                label="Nama Sales"
                name="id_sales"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Status unit" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.status_unit" 
                :items="filterStatusUnit"
                label="Status Unit"
                name="status_unit"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
    
        <validation-provider v-slot="{ errors }" name="Nama unit" rules="required">
            <v-text-field
                class="my-4"
                v-model="form_data.nama_unit"
                label="Nama Unit"
                name="nama_unit"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <address-input inline-template
            :province-value="form_data.provinsi"
            province-class="mt-4"
            province-input-name="provinsi"
            province-label="Provinsi"
            :city-value="form_data.kota"
            city-class="mt-4"
            city-input-name="kota"
            city-label="Kota"
            :district-value="form_data.kecamatan"
            district-class="mt-4"
            district-input-name="kecamatan"
            district-label="Kecamatan"
            :disabled="field_state"
        >
            @include('core::address')
        </address-input>

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


        <div v-if="show_maps">
            <maps-component inline-template
                :latitude-value="form_data.latitude"
                :longitude-value="form_data.longitude"
                latitude-input-name="latitude"
                longitude-input-name="longitude"
                :disabled="field_state"
            >
                @include('core::maps.map')
            </maps-component>
        </div>

        <validation-provider v-slot="{ errors }" name="Luas tanah" rules="required|numeric">
            <v-text-field
                class="my-4"
                v-model="form_data.luas_tanah"
                label="Luas Tanah"
                name="luas_tanah"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            >
                <span slot="append">m<sup>2</sup></span>
            </v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Luas bangunan" rules="required|numeric">
            <v-text-field
                class="my-4"
                v-model="form_data.luas_bangunan"
                label="Luas Bangunan"
                name="luas_bangunan"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            >
                <span slot="append">m<sup>2</sup></span>
            </v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Status bangunan" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.kondisi_bangunan" 
                :items="filterKondisiBangunan"
                label="Status Bangunan"
                name="kondisi_bangunan"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Lebar jalan depan" rules="required|numeric">
            <v-text-field
                class="my-4"
                v-model="form_data.lebar_jalan_depan"
                label="Lebar Jalan Depan"
                name="lebar_jalan_depan"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Sertifikat" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.sertifikat" 
                :items="filterSertifikat"
                label="Sertifikat"
                name="sertifikat"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Atas nama" rules="required">
            <v-text-field
                class="my-4"
                v-model="form_data.atas_nama"
                label="Atas Nama"
                name="atas_nama"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <p>Kelengkapan Surat :</p>
        <v-row>
            <v-col cols="12" md="2">
                <v-checkbox
                        v-model="form_data.kelengkapan_surat"
                        label="HGB"
                        value="HGB"
                        name="kelengkapan_surat[]"
                        :disabled="field_state"
                ></v-checkbox>
            </v-col>
            <v-col cols="12" md="2">
                <v-checkbox
                        v-model="form_data.kelengkapan_surat"
                        label="SHM"
                        value="SHM"
                        name="kelengkapan_surat[]"
                        :disabled="field_state"
                ></v-checkbox>
            </v-col>
            <v-col cols="12" md="2">
                <v-checkbox
                        v-model="form_data.kelengkapan_surat"
                        label="Strata"
                        value="Strata"
                        name="kelengkapan_surat[]"
                        :disabled="field_state"
                ></v-checkbox>
            </v-col>
            <v-col cols="12" md="2">
                <v-checkbox
                        v-model="form_data.kelengkapan_surat"
                        label="Lainya"
                        value="Lainya"
                        name="kelengkapan_surat[]"
                        :disabled="field_state"
                ></v-checkbox>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="12" md="6">
                <validation-provider v-slot="{ errors }" name="Jumlah kamar tidur" rules="required|numeric">
                    <v-text-field
                        class="my-4"
                        v-model="form_data.jumlah_kamar_tidur"
                        label="Jumlah Kamar Tidur"
                        name="jumlah_kamar_tidur"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>
            </v-col>
            <v-col cols="12" md="6">
                 <validation-provider v-slot="{ errors }" name="Jumlah lantai/tingkat" rules="required|numeric">
                    <v-text-field
                        class="my-4"
                        v-model="form_data.jumlah_lantai"
                        label="Jumlah Lantai/Tingkat"
                        name="jumlah_lantai"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>
            </v-col>
             <v-col cols="12" md="6">
                <validation-provider v-slot="{ errors }" name="Jumlah kamar mandi" rules="required|numeric">
                    <v-text-field
                        class="my-4"
                        v-model="form_data.jumlah_kamar_mandi"
                        label="Jumlah Kamar Mandi"
                        name="jumlah_kamar_mandi"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>
            </v-col>
             <v-col cols="12" md="6">
                <validation-provider v-slot="{ errors }" name="Jumlah garasi" rules="required|numeric">
                    <v-text-field
                        class="my-4"
                        v-model="form_data.jumlah_garasi_mobil"
                        label="Jumlah Garasi"
                        name="jumlah_garasi_mobil"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>
            </v-col>
        </v-row>
         <validation-provider v-slot="{ errors }" name="Listrik" rules="required|numeric">
                <v-text-field
                    class="my-4"
                    v-model="form_data.listrik"
                    label="Listrik"
                    name="listrik"
                    clearable
                    clear-icon="mdi-eraser-variant"
                    :persistent-hint="true"
                    :error-messages="errors"
                    :disabled="field_state"
                >
                    <span slot="append">Watt</span>
                </v-text-field>
        </validation-provider>
        <v-row>
            <v-col cols="12" md="6">
                <validation-provider v-slot="{ errors }" name="Telepon Line" rules="required|numeric">
                    <v-text-field
                        class="my-4"
                        v-model="form_data.line_telepon"
                        label="Jumlah Line Telepon"
                        name="line_telepon"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>
            </v-col>
            <v-col cols="12" md="6">
                 <validation-provider v-slot="{ errors }" name="Air" rules="required|numeric">
                    <v-text-field
                        class="my-4"
                        v-model="form_data.air"
                        label="Jumlah Air"
                        name="air"
                        clearable
                        clear-icon="mdi-eraser-variant"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>
            </v-col>
        </v-row>

          <p>Furniture Yang Termasuk :</p>

        <v-row>
            <v-col cols="12" md="2">
                <v-checkbox
                        v-model="form_data.furniture_termasuk"
                        label="Kitchen Set"
                        value="kitchen_set"
                        name="furniture_termasuk[]"
                        :disabled="field_state"
                ></v-checkbox>
            </v-col>
            <v-col cols="12" md="2">
                <v-checkbox
                        v-model="form_data.furniture_termasuk"
                        label="AC"
                        value="AC"
                        name="furniture_termasuk[]"
                        :disabled="field_state"
                ></v-checkbox>
            </v-col>
            <v-col cols="12" md="2">
                <v-checkbox
                        v-model="form_data.furniture_termasuk"
                        label="Lainya"
                        value="Lainya"
                        name="furniture_termasuk[]"
                        :disabled="field_state"
                ></v-checkbox>
            </v-col>
        </v-row>

		<v-textarea
			class="my-4"
			v-model="form_data.deskripsi_unit"
			name="deskripsi_unit"
    		label="Deskripsi Unit"
    		auto-grow
			clearable
			rows="3"
	      	clear-icon="mdi-eraser-variant"
    		:disabled="field_state">
		</v-textarea>

         <validation-provider v-slot="{ errors }" name="Harga Unit" rules="required|numeric">
            <v-text-field
                class="mt-4"
                v-model="form_data.harga_unit"
                label="Harga Unit"
                name="harga_unit"
                hide-details
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
            <small class="form-text text-muted">Rp @{{number_format(form_data.harga_unit)}}</small>
        </validation-provider>

         <validation-provider v-slot="{ errors }" name="Harga/Meter" rules="required|numeric">
            <v-text-field
                class="mt-4"
                v-model="form_data.harga_per_meter"
                label="Harga/Meter"
                name="harga_per_meter"
                hide-details
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
            <small class="form-text text-muted">Rp @{{number_format(form_data.harga_per_meter)}}</small>
        </validation-provider>

        <h3  class="mt-4">Jenis Pembayaran :</h3>
        <v-row>
            <v-col cols="12" md="2"
                v-for="(item, key) in filterJenisPembayaran"
            >
                <v-checkbox
                    v-model="form_data.jenis_pembayaran"
                    :label="item"
                    :value="item"
                    name="jenis_pembayaran[]"
                    :disabled="field_state"
                ></v-checkbox>
            </v-col>
        </v-row>
         
        <h3 class="mt-8">DATA PEMILIK</h3>
        
          <validation-provider v-slot="{ errors }" name="Nama pemilik" rules="required">
            <v-text-field
                class="my-4"
                v-model="form_data.nama_pemilik"
                label="Nama Pemilik"
                name="nama_pemilik"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <v-textarea
            class="my-4"
            v-model="form_data.alamat_lengkap_pemilik"
            name="alamat_lengkap_pemilik"
            label="Alamat Lengkap Pemilik"
            auto-grow
            clearable
            rows="3"
            clear-icon="mdi-eraser-variant"
            :disabled="field_state">
        </v-textarea>

         <validation-provider v-slot="{ errors }" name="No telepon/HP" rules="required|max:15">
            <v-text-field
                class="my-4"
                v-model="form_data.no_telepon_pemilik"
                label="No Telepon/HP"
                name="no_telepon_pemilik"
                v-mask="'+##############'"
                placeholder="+62812411111111"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

          <validation-provider v-slot="{ errors }" name="No NPWP" rules="required|numeric">
            <v-text-field
                class="my-4"
                v-model="form_data.no_npwp_pemilik"
                label="No NPWP"
                name="no_npwp_pemilik"
                clearable
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

         <validation-provider v-slot="{ errors }" name="Bersedia di pasang spanduk" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.bersedia_dipasang" 
                :items="filterBersediaDipasang"
                label="Bersedia Dipasang Spanduk"
                name="bersedia_dipasang"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
                 @change="form_data.jangka_waktu_pemasangan = ''"
            ></v-autocomplete>
        </validation-provider>

        <div  v-if="form_data.bersedia_dipasang != 'Tidak' ">
            <h3 class="mt-8">Jangka Waktu Pemasangan</h3>
            <v-row>
                <v-col
                    cols="12"
                    md="6">
                        <v-menu
                        v-model="start_date"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        transition="scale-transition"
                        offset-y
                        min-width="290px"
                      >
                        <template v-slot:activator="{ on, attrs }">
                        <validation-provider v-slot="{ errors }" name="Tanggal mulai pemasangan" rules="required">
                            <v-text-field
                                :value="reformatDateTime(form_data.start_date_iklan, 'YYYY-MM-DD', 'DD MMMM YYYY')"
                                hint="* harus diisi"
                                :persistent-hint="true"
                                :error-messages="errors"
                                label="Tanggal Mulai Pasang"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </validation-provider>
                        </template>
                        <v-date-picker v-model="form_data.start_date_iklan" @input="start_date = false"></v-date-picker>
                    </v-menu>
                </v-col>
                <v-col
                    cols="12"
                    md="6">
                        <v-menu
                        v-model="end_date"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        transition="scale-transition"
                        offset-y
                        min-width="290px"
                      >
                        <template v-slot:activator="{ on, attrs }">
                        <validation-provider v-slot="{ errors }" name="Tanggal akhir pemasangan" rules="required">
                            <v-text-field
                                :value="reformatDateTime(form_data.end_date_iklan, 'YYYY-MM-DD', 'DD MMMM YYYY')"
                                hint="* harus diisi"
                                :persistent-hint="true"
                                :error-messages="errors"
                                label="Tanggal Selesai Pasang"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>
                        </validation-provider>
                        </template>
                        <v-date-picker v-model="form_data.end_date_iklan" @input="end_date = false"></v-date-picker>
                    </v-menu>
                </v-col>
            </v-row>
        </div>


        <validation-provider v-slot="{ errors }" name="Bersedia open house" rules="required">
             <v-autocomplete
                class="my-4"
                v-model="form_data.open_house" 
                :items="filterOpenHouse"
                label="Bersedia Open House"
                name="open_house"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>


        <div  class="mb-4">
            <v-file-input
                counter
                small-chips
                multiple
                accept="image/*"
                name="gallery_unit[]"
                label="Gallery Unit"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
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
        </div>

        <validation-provider v-slot="{ errors }" name="Approved status" rules="" v-if="form_data.for_status != null">
             <v-autocomplete
                class="my-4"
                v-model="form_data.approved_status" 
                :items="filterApprovedStatus"
                label="Approved Status"
                name="approved_status"
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

    <v-overlay
        :absolute="true"
        opacity="0"
        :value="field_state"
    ></v-overlay>
</validation-observer>