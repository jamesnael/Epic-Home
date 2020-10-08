<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider v-slot="{ errors }" name="Tipe proyek" rules="">
            <v-autocomplete
                class="my-4"
                v-model="form_data.id_tipe_proyek"
                label="Tipe Proyek"
                name="id_tipe_proyek"
                :items="filterTipeProyek"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Tipe bangunan" rules="">
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
            ></v-autocomplete>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Status unit" rules="">
            <v-autocomplete
                class="my-4"
                v-model="form_data.status_unit"
                label="Status Unit"
                hint="* harus diisi"
                name="status_unit"
                :items="['Dijual', 'Disewa', 'Dijual/Disewa']"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider rules="" name="Nama proyek" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.nama_proyek"
                label="Nama Proyek"
                clearable
                clear-icon="mdi-eraser-variant"
                name="nama_proyek"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Provinsi" rules="">
            <v-text-field
                class="my-4"
                v-model="form_data.provinsi"
                label="Provinsi"
                clearable
                clear-icon="mdi-eraser-variant"
                name="provinsi"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Kota" rules="">
            <v-text-field
                class="my-4"
                v-model="form_data.kota"
                label="Kota"
                clearable
                clear-icon="mdi-eraser-variant"
                name="kota"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider rules="" name="Alamat lengkap" v-slot="{ errors }">
            <v-textarea
                class="my-4"
                v-model="form_data.alamat"
                name="alamat"
                label="Alamat Lengkap"
                auto-grow
                clearable
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                rows="3"
                clear-icon="mdi-eraser-variant"
                :disabled="field_state">
            </v-textarea>
        </validation-provider>

        <div class="form-group row">
            <div class="col-md-12">
                <div id="proyek-primary-map"></div>
            </div>
        </div>
        <v-row>
            <v-col cols="12" md="6">
                <v-text-field
                    class="my-4"
                    v-model="form_data.latitude"
                    label="Latitude"
                    clearable
                    name="latitude"
                    :disabled="field_state"
                ></v-text-field>
            </v-col>
            <v-col cols="12" md="6">
                <v-text-field
                    class="my-4"
                    v-model="form_data.longitude"
                    label="Longitude"
                    clearable
                    name="longitude"
                    :persistent-hint="true"
                    :disabled="field_state"
                ></v-text-field>
            </v-col>
        </v-row>
        
        <div  class="mb-4 my-4">
            <v-file-input
                v-model="form_data.google_map_gallery"
                small-chips
                multiple
                accept="image/*"
                name="google_map_gallery[]"
                label="Google Map Gallery"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
        </div>
        <validation-provider rules="|numeric" name="Harga mulai dari" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.harga_awal"
                label="Harga Mulai Dari"
                clearable
                clear-icon="mdi-eraser-variant"
                name="harga_awal"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
            <small class="form-text text-muted">Rp @{{ form_data.harga_awal ? number_format(form_data.harga_awal) : 0 }}</small>
        </validation-provider>
        <validation-provider rules="|numeric" name="NUP" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.nup"
                label="NUP"
                clearable
                clear-icon="mdi-eraser-variant"
                name="nup"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
            <small class="form-text text-muted">Rp @{{ form_data.nup ? number_format(form_data.nup) : 0 }}</small>
        </validation-provider>
        <validation-provider rules="|numeric" name="UTJ" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.utj"
                label="UTJ"
                name="utj"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
            <small class="form-text text-muted">Rp @{{ form_data.utj ? number_format(form_data.utj) : 0 }}</small>
        </validation-provider>
        <validation-provider rules="|numeric" name="Komisi" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.komisi"
                name="komisi"
                label="Komisi"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider rules="" name="Closing fee hingga" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.closing_fee"
                name="closing_fee"
                label="Closing Fee Hingga"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
            <small class="form-text text-muted">Rp @{{ form_data.closing_fee ? number_format(form_data.closing_fee) : 0 }}</small>
        </validation-provider>
        <validation-provider rules="" name="Reward" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.reward"
                name="reward"
                label="Reward"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider rules="" name="Jenis pembayaran tersedia" v-slot="{ errors }">
            <v-autocomplete
                class="my-4"
                v-model="form_data.jenis_pembayaran"
                label="Jenis Pembayaran Tersedia"
                name="jenis_pembayaran"
                :items="['Installment', 'KPR/KPA', 'Hardcash']"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        

        <h2 class="my-6">Spesifikasi</h2>
        <validation-provider rules="" name="Tahun selesai" v-slot="{ errors }">
            <v-text-field
                v-model="form_data.tahun_selesai"
                name="tahun_selesai"
                label="Tahun Selesai"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider rules="" name="Estimasi selesai" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.estimasi_selesai"
                name="estimasi_selesai"
                label="Estimasi Selesai"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider rules="" name="Lingkungan sekitar komplek" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.lingkungan_sekitar"
                name="lingkungan_sekitar"
                label="Lingkungan Sekitar Komplek"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider rules="" name="Jumlah tower" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.jumlah_tower"
                name="jumlah_tower"
                label="Jumlah Tower"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
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
        <h3  class="mt-4">Fasilitas :</h3>
        <v-row>
            <v-col cols="12" md="3">
                <v-checkbox
                        v-model="form_data.fasilitas"
                        label="Keamanan 24 Jam"
                        value="Keamanan 24 Jam"
                        name="fasilitas[]"
                ></v-checkbox>
                <v-checkbox
                        v-model="form_data.fasilitas"
                        label="CCTV"
                        value="CCTV"
                        name="fasilitas[]"
                ></v-checkbox>
            </v-col>
            <v-col cols="12" md="3">
                <v-checkbox
                        v-model="form_data.fasilitas"
                        label="Taman"
                        value="Taman"
                        name="fasilitas[]"
                ></v-checkbox>
                <v-checkbox
                        v-model="form_data.fasilitas"
                        label="Tempat Parkir"
                        value="Tempat Parkir"
                        name="fasilitas[]"
                ></v-checkbox>
            </v-col>
            <v-col cols="12" md="3">
                <v-checkbox
                        v-model="form_data.fasilitas"
                        label="AC"
                        value="AC"
                        name="fasilitas[]"
                ></v-checkbox>
                <v-checkbox
                        v-model="form_data.fasilitas"
                        label="Balkon"
                        value="Balkon"
                        name="fasilitas[]"
                ></v-checkbox>
            </v-col>
            <v-col cols="12" md="3">
                <v-checkbox
                        v-model="form_data.fasilitas"
                        label="Kolam Renang"
                        value="Kolam Renang"
                        name="fasilitas[]"
                ></v-checkbox>
                <v-checkbox
                        v-model="form_data.fasilitas"
                        label="Gedung Pertemuan"
                        value="Gedung Pertemuan"
                        name="fasilitas[]"
                ></v-checkbox>
            </v-col>
        </v-row>
        
       <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="Profile Proyek" rules="">
                    <h3 class="font-weight-medium">Profile Proyek</h3>
                    <wysiwyg 
                        class="mt-1"
                        name="profile_proyek"
                        label="Profile Proyek"
                        :error-messages="errors"
                        hint="* harus diisi"
                        :persistent-hint="true"
                        :readonly="field_state">
                    </wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* harus diisi</h5>
                </validation-provider>
            </v-col>
        </v-row>
        <validation-provider v-slot="{ errors }" name="Developer" rules="">
            <v-autocomplete
                class="my-4"
                v-model="form_data.id_developer"
                label="Developer"
                name="id_developer"
                :items="filterDeveloper"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider rules="" name="Nama PIC" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.nama_pic"
                name="nama_pic"
                label="Nama PIC"
                auto-grow
                clearable
                rows="3"
                :persistent-hint="true"
                :error-messages="errors"
                clear-icon="mdi-eraser-variant"
                :disabled="field_state">
            </v-text-field>
        </validation-provider>
        <validation-provider rules="" name="Nomor handphone" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.nomor_handphone"
                name="nomor_handphone"
                label="Nomor Handphone"
                auto-grow
                clearable
                rows="3"
                :persistent-hint="true"
                :error-messages="errors"
                clear-icon="mdi-eraser-variant"
                :disabled="field_state">
            </v-text-field>
        </validation-provider>
        <validation-provider rules="" name="Copywriting" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.copywriting"
                name="copywriting"
                label="Copywriting"
                auto-grow
                clearable
                rows="3"
                :persistent-hint="true"
                :error-messages="errors"
                clear-icon="mdi-eraser-variant"
                :disabled="field_state">
            </v-text-field>
        </validation-provider>
        
        <h2>Point Of Interest</h2>
        <v-row
            class="d-flex align-end flex-column mr-2"
            justify="space-around">
            <v-btn
                tile
                color="primary"
                v-on:click="addFasilitasUmum">
                <v-icon left>
                    mdi-plus
                </v-icon>
                Tambah Fasilitas Umum
            </v-btn>
        </v-row>
        <div
            v-for="(el, idx) in form_data.fasilitas_umum">
            <v-row
                class="mt-4">
                <v-col
                    cols="12"
                    md="4">
                    <v-text-field
                        class="mt-3"
                        v-model="el.nama_fasilitas_umum"
                        name="fasilitas_umum[][nama_fasilitas_umum]"
                        clearable
                        label="Fasilitas Umum"
                        type="text"
                        :disabled="field_state"
                    ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    md="4">
                    <v-text-field
                        class="mt-3"
                        v-model="el.detail_fasilitas_umum"
                        name="fasilitas_umum[][detail_fasilitas_umum]"
                        clearable
                        label="Nama Fasilitas Umum"
                        type="text"
                        :disabled="field_state"
                    ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    md="4">
                    <v-text-field
                        class="mt-3"
                        v-model="el.jarak"
                        name="fasilitas_umum[][jarak]"
                        clearable
                        label="Jarak"
                        type="text"
                        append-outer-icon="mdi-delete-circle-outline"
                        @click:append-outer="removeFasilitasUmum(idx)"
                        :disabled="field_state"
                    ></v-text-field>
                </v-col>
            </v-row>
        </div>

        <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="Broadcast message" rules="">
                    <h3 class="font-weight-medium">Broadcast Message</h3>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.broadcast_message"
                        name="broadcast_message"
                        label="Broadcast Message"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :readonly="field_state">
                    </wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* harus diisi</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="Q&A" rules="">
                    <h3 class="font-weight-medium">Q&A</h3>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.question_answer"
                        name="question_answer"
                        label="Q&A"
                        persistent-hint="true"
                        :error-messages="errors"
                        :readonly="field_state">
                    </wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* harus diisi</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <div  class="mb-4">
            <v-file-input
                v-model="form_data.banner_proyek"
                small-chips
                multiple
                accept="image/*"
                name="banner_proyek"
                label="Banner Proyek"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
        </div>

        <div  class="mb-4">
            <v-file-input
                v-model="form_data.progress_update"
                small-chips
                multiple
                accept="image/*"
                name="progress_update[]"
                label="Progress Update"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
        </div>

        <div  class="mb-4">
            <v-file-input
                v-model="form_data.product_knowledge"
                small-chips
                multiple
                name="product_knowledge"
                label="Product Knowledge"
                :disabled="field_state"
            >
            </v-file-input>
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