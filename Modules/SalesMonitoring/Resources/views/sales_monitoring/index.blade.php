@extends('core::layouts.master')

@push('table_slot')
    <template v-slot:item.detail="{ item }">
        <v-dialog persistent max-width="700" v-model="item.dialog">
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                    icon
                    color="primary"
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-icon small>
                        mdi-eye
                    </v-icon>
                </v-btn>
            </template>
            <v-card>
                <v-card-title>Detail Monitoring Client @{{item.klien.nama_klien}}</v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <div class="mt-5">
                        <strong>Notes :</strong>
                        <v-textarea
                            v-model="item.note"
                            auto-grow
                            filled
                            rows="5"
                            class="mt-2"
                            name="note"
                            :readonly="true"
                        >
                        </v-textarea>

                        <strong>File Attachment :</strong><br>
                        <a v-if="item.file_attachment" :href="item.url_file_attachment " target="_blank">Click here to view file</a>
                        <span v-else>-</span>
                    </div>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text @click="item.dialog = false">Tutup</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </template>

@endpush

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<table-component inline-template
    					table-number
    					with-actions
    					uri="{{ route('sales-monitoring.table') }}"
    					:headers='@json($table_headers)'
    					no-data-text="Tidak ada data ditemukan."
    					no-results-text="Tidak ada data ditemukan."
    					search-text="Pencarian"
    					refresh-text="Muat Ulang"
    					items-per-page-all-text="Semua"
    					items-per-page-text="Tampilkan"
    					page-text-locale="id"
    					delete-uri="sales-monitoring.destroy"
    					delete-uri-parameter="slug"
    					delete-text="Hapus"
    					delete-confirmation-text="Apakah Anda yakin untuk menghapus data ini ?"
    					delete-cancel-text="Batal"
    				>
    					
    					@include('core::components.table')
    				</table-component>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
