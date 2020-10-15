<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Jenis bank" v-slot="{ errors }">
            <v-autocomplete
                class="my-4"
                v-model="form_data.jenis_bank" 
                :items="filterJenisBank"
                label="Jenis Bank"
                name="jenis_bank"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-autocomplete>
        </validation-provider>

        <validation-provider rules="required" name="Nama bank" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.nama_bank"
                label="Nama Bank"
                name="nama_bank"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Nama pinjaman" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.nama_pinjaman"
                label="Nama Pinjaman"
                name="nama_pinjaman"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Suku bunga" rules="numeric">
            <v-text-field
                class="mt-4"
                v-model="form_data.suku_bunga"
                name="suku_bunga"
                label="Suku Bunga"
                {{-- type="number" --}}
                hint="* harus diisi"
                :readonly="form_data.flat_suku_bunga"
                :persistent-hint="true"
                :error-messages="errors">
                <v-icon slot="append">mdi-percent-outline</v-icon>
            </v-text-field>
        </validation-provider>
        <v-checkbox
            v-model="form_data.flat_suku_bunga"
            name="flat_suku_bunga"
            label="Flat"
            hide-details
            class="shrink mr-2 mt-0"
            @change="form_data.suku_bunga = ''"
        ></v-checkbox>

        <validation-provider rules="required|numeric" name="Masa kredit fix" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.masa_kredit"
                label="Masa kredit fix"
                name="masa_kredit"
                {{-- type="number" --}}
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>
        
        
        <h3 class="mt-8">TENOR</h3>

        <v-row>
            <v-col cols="12"
            md="6">
                <validation-provider rules="required|numeric" name="Mulai dari" v-slot="{ errors }">
                    <v-text-field
                        class="mt-4"
                        v-model="form_data.tenor_mulai_dari"
                        label="Mulai dari"
                        name="tenor_mulai_dari"
                        {{-- type="number" --}}
                        clearable
                        clear-icon="mdi-eraser-variant"
                        hint="* harus diisi"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                    <small class="form-text text-muted">Rp @{{number_format(form_data.tenor_mulai_dari)}}</small>
                </validation-provider>
            </v-col>
            <v-col cols="12"
            md="6">
                <validation-provider rules="required|numeric" name="Sampai dengan" v-slot="{ errors }">
                    <v-text-field
                        class="mt-4"
                        v-model="form_data.tenor_sampai_dengan"
                        label="Sampai Dengan"
                        name="tenor_sampai_dengan"
                        {{-- type="number" --}}
                        clearable
                        clear-icon="mdi-eraser-variant"
                        hint="* harus diisi"
                        :persistent-hint="true"
                        :error-messages="errors"
                        :disabled="field_state"
                    ></v-text-field>
                    <small class="form-text text-muted">Rp @{{number_format(form_data.tenor_sampai_dengan)}}</small>
                </validation-provider>
            </v-col>
        </v-row>
        <validation-provider rules="required" name="Status" v-slot="{ errors }">
            <v-autocomplete
                class="my-4"
                v-model="form_data.status" 
                :items="filterStatus"
                label="Status"
                name="status"
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