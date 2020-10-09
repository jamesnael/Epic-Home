@extends('core::layouts.master')

@push('table_slot')
<template v-slot:item.thumbnail="{ item }">
    <v-img
        class="mt-2 mb-2"
        max-width="100"
        :src="item.thumbnail"
    ></v-img>
</template>
<template v-slot:item.publish="{ item }">
    <v-chip
        :color="item.publish == 'Publish' ? 'green' : 'red'"
        text-color="white"
    >
        @{{ item.publish.toUpperCase() }}
    </v-chip>
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
    					uri="{{ route('berita-properti.table') }}"
    					:headers='@json($table_headers)'
    					no-data-text="Tidak ada data ditemukan."
    					no-results-text="Tidak ada data ditemukan."
    					search-text="Pencarian"
    					refresh-text="Muat Ulang"
    					items-per-page-all-text="Semua"
    					items-per-page-text="Tampilkan"
    					page-text-locale="id"
    					add-new-uri="{{ route('berita-properti.create') }}"
    					add-new-text="Tambah"
    					add-new-color="light-blue lighten-2"
    					edit-uri="berita-properti.edit"
    					edit-uri-parameter="slug"
    					edit-text="Ubah"
    					delete-uri="berita-properti.destroy"
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
