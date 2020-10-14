<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required" name="Menu" v-slot="{ errors }">
            <v-select
                class="my-4"
                v-model="form_data.menu" 
                :items="filterMenu"
                label="Menu"
                name="menu"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :readonly="field_state"
            ></v-select>
        </validation-provider>

        <validation-provider rules="required" name="Kategori" v-slot="{ errors }">
            <v-combobox
                class="my-4"
                v-model="form_data.kategori"
                :items="filterKategori"
                :search-input.sync="search_kategori"
                label="Kategori"
                name="kategori"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            >
                <template v-slot:no-data>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>
                                No results matching "<strong>@{{ search_kategori }}</strong>". Press <kbd>enter</kbd> to create a new one
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-combobox>
        </validation-provider>

        <validation-provider rules="required" name="Pertanyaan" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.pertanyaan"
                label="Pertanyaan"
    			name="pertanyaan"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* harus diisi"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="Jawaban" rules="required">
                    <h3 class="font-weight-medium">Jawaban</h3>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.jawaban"
                        name="jawaban"
                        label="Jawaban"
                        :error-messages="errors"
                        :readonly="field_state"
                    ></wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* harus diisi</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <v-switch
            class="my-4"
            v-model="form_data.publish"
            name="publish"
            label="Publish"
            :true-value="1"
            :false-value="0"
            inset
        ></v-switch>
        
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