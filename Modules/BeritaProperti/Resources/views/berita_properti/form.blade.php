<validation-observer v-slot="{ validate, reset }" ref="observer">
    <form method="post" enctype="multipart/form-data" ref="post-form">
        <validation-provider rules="required|max:190" name="Judul" v-slot="{ errors }">
            <v-text-field
            	class="my-4"
                v-model="form_data.judul"
                label="Judul"
    			name="judul"
    			clearable
    			clear-icon="mdi-eraser-variant"
	    		hint="* harus diisi"
	    		:persistent-hint="true"
	    		:error-messages="errors"
	    		:disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <validation-provider rules="required" name="Tag" v-slot="{ errors }">
            <v-combobox
                class="my-4"
                v-model="form_data.tag"
                :items="filterTag"
                :search-input.sync="search_tag"
                label="Tag"
                name="tag"
                hint="* harus diisi"
                hide-selected
                multiple
                chips
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            >
                <template v-slot:no-data>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>
                                No results matching "<strong>@{{ search_tag }}</strong>". Press <kbd>enter</kbd> to create a new one
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-combobox>
        </validation-provider>

        <validation-provider rules="required|min:120|max:320" name="Deskripsi" v-slot="{ errors }">
            <v-textarea
                class="my-4"
                rows="3"
                v-model="form_data.deskripsi"
                label="Deskripsi"
                name="deskripsi"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-textarea>
        </validation-provider>

        <v-row>
            <v-col cols="12">
                <validation-provider v-slot="{ errors }" name="Konten" rules="required">
                    <h3 class="font-weight-medium">Konten</h3>
                    <wysiwyg 
                        class="mt-1"
                        v-model="form_data.konten"
                        name="konten"
                        label="Konten"
                        :error-messages="errors"
                        :readonly="field_state"
                    ></wysiwyg>
                    <h5 class="mb-2 font-weight-medium">* harus diisi</h5>
                </validation-provider>
            </v-col>
        </v-row>

        <validation-provider v-slot="{ errors }" name="Thumbnail" rules="image">
            <v-file-input
                accept="image/*"
                prepend-icon="mdi-camera"
                hint="hanya menerima file dalam format image"
                :persistent-hint="true"
                clear-icon="mdi-eraser-variant"
                show-size
                label="Thumbnail"
                name="thumbnail"
                :disabled="field_state"
            ></v-file-input>
            <v-row class="mb-3">
                <v-col
                    v-if="form_data.url_thumbnail"
                    cols="12"
                    md="3"
                >
                    <a :href="form_data.url_thumbnail" target="_blank">
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
                                :src="form_data.url_thumbnail"
                            ></v-img>
                        </v-card>
                        
                    </a>
                </v-col>
            </v-row>
        </validation-provider>

        <validation-provider v-slot="{ errors }" name="Banner" rules="image">
            <v-file-input
                accept="image/*"
                prepend-icon="mdi-camera"
                hint="hanya menerima file dalam format image"
                :persistent-hint="true"
                clear-icon="mdi-eraser-variant"
                show-size
                label="Banner"
                name="banner[]"
                multiple
                :disabled="field_state"
            ></v-file-input>
            <v-row class="mb-3">
                <v-col
                    v-for="(el, idx) in form_data.url_banner"
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
        
        <validation-provider rules="required" name="Penulis|max:190" v-slot="{ errors }">
            <v-text-field
                class="my-4"
                v-model="form_data.penulis"
                label="Penulis"
                name="penulis"
                clearable
                clear-icon="mdi-eraser-variant"
                hint="* harus diisi"
                :persistent-hint="true"
                :error-messages="errors"
                :disabled="field_state"
            ></v-text-field>
        </validation-provider>

        <v-menu
            v-model="menu1"
            :close-on-content-click="false"
            :nudge-right="40"
            transition="scale-transition"
            offset-y
            min-width="290px"
        >
            <template v-slot:activator="{ on, attrs }">
                <validation-provider v-slot="{ errors }" name="Publish Date" rules="required|min:1">
                    <v-text-field
                        class="mt-4"
                        :value="reformatDateTime(form_data.publish_date, 'YYYY-MM-DD', 'DD MMMM YYYY')"
                        hint="* harus diisi"
                        :persistent-hint="true"
                        :error-messages="errors"
                        label="Publish Date"
                        v-bind="attrs"
                        v-on="on"
                        :readonly="!field_state"
                        :disabled="field_state"
                    ></v-text-field>
                </validation-provider>
            </template>
            <v-date-picker name="publish_date" v-model="form_data.publish_date" @input="menu1 = false"></v-date-picker>
        </v-menu>

        <v-switch
            class="my-4"
            v-model="form_data.publish"
            name="publish"
            label="Publish"
            :true-value="1"
            :false-value="0"
            inset
            :disabled="field_state"
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