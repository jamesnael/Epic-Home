<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider v-slot="{ errors }" name="Tipe proyek" rules="required">
             <v-autocomplete
                class="my-4"
                label="Tipe Proyek"
                name=""
                :items="filterTipeProyek"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Tipe bangunan" rules="required">
             <v-autocomplete
                class="my-4"
                label="Tipe Bangunan"
                name=""
                :items="filterTipeBangunan"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Cluster" rules="required">
             <v-autocomplete
                class="my-4"
                label="Cluster"
                name=""
                :items="filterCluster"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Tipe unit" rules="required">
             <v-autocomplete
                class="my-4"
                label="Tipe Unit"
                hint="* harus diisi"
                :items="filterTipeUnit"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

         <validation-provider v-slot="{ errors }" name="Status unit" rules="required">
             <v-autocomplete
                class="my-4"
                label="Status Unit"
                hint="* harus diisi"
                :items="['Dijual', 'Disewa', 'Dijual/Disewa']"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        
        <validation-provider rules="required" name="Nama proyek" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="Nama Proyek"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Kota" rules="required">
             <v-autocomplete
                class="my-4"
                label="Kota"
                name=""
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Kecamatan" rules="required">
             <v-autocomplete
                class="my-4"
                label="Kecamatan"
                name=""
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>


        <validation-provider rules="required" name="Alamat lengkap" v-slot="{ errors }">
            <v-textarea
                class="my-4"
                name=""
                label="Alamat Lengkap"
                auto-grow
                clearable
                rows="3"
                clear-icon="mdi-eraser-variant"
                :disabled="field_state">
            </v-textarea>
        </validation-provider>

        <div  class="mb-4">
            <v-file-input
                small-chips
                multiple
                accept="image/*"
                name="image[]"
                label="Logo"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
        </div>

        <validation-provider rules="required" name="Harga mulai dari" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="Harga Mulai Dari"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="NUP" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="NUP"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="UTJ" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="UTJ"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Komisi" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="Komisi"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Closing fee hingga" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="Closing Fee Hingga"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Reward" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="Reward"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Jenis pembayaran tersedia" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="Jenis Pembayaran Tersedia"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <h2 class="my-6">Spesifikasi</h2>
        <validation-provider rules="required" name="Tahun selesai" v-slot="{ errors }">
            <v-text-field
                label="Tahun Selesai"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Estimasi selesai" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="Estimasi Selesai"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Lingkungan sekitar komplek" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="Lingkungan Sekitar Komplek"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Jumlah tower" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="Jumlah Tower"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Sertifikat" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="Sertifikat"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Fasilitas" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                label="Fasilitas"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        <validation-provider rules="required" name="Profile proyek" v-slot="{ errors }">
            <v-textarea
                class="my-4"
                name=""
                label="Profile Proyek"
                auto-grow
                clearable
                rows="3"
                clear-icon="mdi-eraser-variant"
                :disabled="field_state">
            </v-textarea>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Developer" rules="required">
             <v-autocomplete
                class="my-4"
                label="Developer"
                name=""
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

        <validation-provider rules="required" name="Nama PIC" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                name=""
                label="Nama PIC"
                auto-grow
                clearable
                rows="3"
                clear-icon="mdi-eraser-variant"
                :disabled="field_state">
            </v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Nomor handphone" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                name=""
                label="Nomor Handphone"
                auto-grow
                clearable
                rows="3"
                clear-icon="mdi-eraser-variant"
                :disabled="field_state">
            </v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Copywriting" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                name=""
                label="Copywriting"
                auto-grow
                clearable
                rows="3"
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
                        v-model="el.nama"
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
                        v-model="form_data.fasilitas_umum[idx]"
                        name="fasilitas_umum[][detail_fasilitas_umum]"
                        clearable
                        label=""
                        type="text"
                        :disabled="field_state"
                    ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    md="4">
                    <v-text-field
                        class="mt-3"
                        v-model="form_data.fasilitas_umum[idx]"
                        name="fasilitas_umum[][jarak]"
                        clearable
                        label=""
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
                <validation-provider v-slot="{ errors }" name="Broadcast message" rules="required">
                    <h3 class="font-weight-medium">Broadcast Message</h3>
                    <wysiwyg 
                        class="mt-1"
                        name="jawaban"
                        label="Jawaban"
                        :error-messages="errors"
                        :readonly="field_state">
                    </wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* harus diisi</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="Q&A" rules="required">
                    <h3 class="font-weight-medium">Q&A</h3>
                    <wysiwyg 
                        class="mt-1"
                        name="jawaban"
                        label="Jawaban"
                        :error-messages="errors"
                        :readonly="field_state">
                    </wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* harus diisi</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <div  class="mb-4">
            <v-file-input
                small-chips
                multiple
                accept="image/*"
                name="image[]"
                label="Banner Proyek"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
        </div>

        <div  class="mb-4">
            <v-file-input
                small-chips
                multiple
                accept="image/*"
                name="image[]"
                label="Progress Update"
                prepend-icon="mdi-camera"
                :disabled="field_state"
            >
            </v-file-input>
        </div>

        <div  class="mb-4">
            <v-file-input
                small-chips
                multiple
                name="image[]"
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