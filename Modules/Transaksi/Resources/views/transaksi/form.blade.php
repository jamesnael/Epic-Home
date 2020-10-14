<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <v-card>
            <v-card-title>
                Informasi Data Pemesanan
            </v-card-title>
            <v-card-text>
                <v-row>
                    <v-col
                        cols="12"
                        md="6">
                        <v-text-field
                            :value="reformatDateTime(form_data.tanggal_pemesanan, 'YYYY-MM-DD', 'DD MMMM YYYY')"
                            label="Tanggal Pemesanan"
                            :readonly="!field_state"
                            :disabled="field_state">
                        </v-text-field>
                    </v-col>
                    <v-col
                        cols="12"
                        md="6">
                        <v-text-field
                            v-model="form_data.nama_proyek"
                            label="Nama Proyek"
                            :readonly="!field_state"
                            :disabled="field_state">
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col
                        cols="12"
                        md="6">
                        <v-text-field
                            v-model="form_data.tipe_unit"
                            label="Tipe Unit"
                            :readonly="!field_state"
                            :disabled="field_state">
                        </v-text-field>
                    </v-col>
                    <v-col
                        cols="12"
                        md="6">
                        <v-text-field
                            v-model="form_data.harga_unit"
                            label="Harga Unit"
                            :readonly="!field_state"
                            :disabled="field_state">
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col
                        cols="12"
                        md="6">
                        <v-text-field
                            v-model="form_data.cara_bayar"
                            label="Cara Bayar"
                            :readonly="!field_state"
                            :disabled="field_state">
                        </v-text-field>
                    </v-col>
                    <v-col
                        cols="12"
                        md="6">
                        <v-text-field
                            v-model="form_data.klien"
                            label="Nama Klien"
                            :readonly="!field_state"
                            :disabled="field_state">
                        </v-text-field>
                    </v-col>
                </v-row>
                <v-row>
                    <v-col
                        cols="12"
                        md="6">
                        <v-text-field
                            v-model="form_data.telepon"
                            label="Nomor Telepon"
                            :readonly="!field_state"
                            :disabled="field_state">
                        </v-text-field>
                    </v-col>
                    <v-col
                        cols="12"
                        md="6">
                        <v-text-field
                            v-model="form_data.nama_sales"
                            label="Nama Sales"
                            :readonly="!field_state"
                            :disabled="field_state">
                        </v-text-field>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>


        <h3 class="mt-6">Input Tagihan Pembayaran</h3>
        <v-text-field
            v-model="form_data.id_unit"
            v-show=false
            name="id_unit">
        </v-text-field>
        <v-text-field
            v-model="form_data.id_klien"
            v-show=false
            name="id_klien">
        </v-text-field>
        <validation-provider rules="required" name="Untuk pembayaran" v-slot="{ errors }">
            <v-autocomplete
                class="my-4"
                v-model="form_data.perihal_pembayaran" 
                :items="['Booking Fee','Reserved', 'NUP']"
                label="Untuk Pembayaran"
                name="perihal_pembayaran"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>
        <validation-provider v-slot="{ errors }" name="Total pembayaran" rules="required|numeric|min:0">
            <v-text-field
                class="mt-4"
                v-model="form_data.jumlah_bayar"
                label="Total Pembayaran"
                name="jumlah_bayar"
                clearable
                hide-details
                clear-icon="mdi-eraser-variant"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
            <small class="form-text text-muted">Rp @{{ form_data.jumlah_bayar ? number_format(form_data.jumlah_bayar) : 0 }}</small>
        </validation-provider>
        <validation-provider rules="required" name="Terbilang" v-slot="{ errors }">
            <v-textarea
                class="my-4"
                auto-grow
                clearable
                rows="1"
                clear-icon="mdi-eraser-variant"
                v-model="form_data.terbilang"
                label="Terbilang"
                name="terbilang"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-textarea>
        </validation-provider>
        <validation-provider rules="" name="" v-slot="{ errors }">
            <v-textarea
                class="my-4"
                auto-grow
                clearable
                rows="1"
                clear-icon="mdi-eraser-variant"
                v-model="form_data.keterangan"
                label="Keterangan"
                name="keterangan"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-textarea>
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