@extends('core::layouts.master')

@section('content')
@push('table_slot')

<template v-slot:item.status_sales="{ item }">
    <v-chip
        :color="item.status_sales == 'Sukses' ? 'green' : item.status_sales == 'Verifikasi' ? 'yellow' : 'red'"
        text-color="white"
    >
        @{{ item.status_sales.toUpperCase() }}
    </v-chip>
</template>
@endpush


 <v-tabs>
    <v-tab>
        Pending
    </v-tab>
    <v-tab-item>    
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<table-component inline-template
    					table-number
    					with-actions
    					uri="{{ route('sales.table') }}"
    					:headers='@json($table_headers)'
    					no-data-text="Tidak ada data ditemukan."
    					no-results-text="Tidak ada data ditemukan."
    					search-text="Pencarian"
    					refresh-text="Muat Ulang"
    					items-per-page-all-text="Semua"
    					items-per-page-text="Tampilkan"
    					page-text-locale="id"
                        add-new-uri="{{ route('sales.create') }}"
                        add-new-text="Tambah"
                        add-new-color="light-blue lighten-2"
    					edit-uri="sales.edit"
    					edit-uri-parameter="slug"
    					edit-text="Ubah"
    					delete-uri="sales.destroy"
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
     </v-tab-item>

    <v-tab>
        Approved
    </v-tab>
    <v-tab-item>
     <v-row
        class="px-md-4 px-sm-2">
        <v-col cols="12">
            <v-card>
                <v-card-text>
                    <table-component inline-template
                        table-number
                        with-actions
                        uri="{{ route('sales-approved.table') }}"
                        :headers='@json($table_headers)'
                        no-data-text="Tidak ada data ditemukan."
                        no-results-text="Tidak ada data ditemukan."
                        search-text="Pencarian"
                        refresh-text="Muat Ulang"
                        items-per-page-all-text="Semua"
                        items-per-page-text="Tampilkan"
                        page-text-locale="id"
                        edit-uri="sales.edit"
                        edit-uri-parameter="slug"
                        edit-text="Ubah"
                        delete-uri="sales.destroy"
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
    </v-tab-item>
</v-tabs>
@endsection
