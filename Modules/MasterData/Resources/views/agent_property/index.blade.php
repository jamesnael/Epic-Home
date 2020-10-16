@extends('core::layouts.master')
@push('table_slot')
<template v-slot:item.nama_agent_property="{ item }">
    <template>
        <v-list-item-avatar v-if="item.logo_agent">
            <img :src="item.logo_agent">
        </v-list-item-avatar>
        <v-list-item-content>
            <v-list-item-title v-html="item.nama_agent_property"></v-list-item-title>
        </v-list-item-content>
    </template>
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
    					uri="{{ route('agent-property.table') }}"
    					:headers='@json($table_headers)'
    					no-data-text="Tidak ada data ditemukan."
    					no-results-text="Tidak ada data ditemukan."
    					search-text="Pencarian"
    					refresh-text="Muat Ulang"
    					items-per-page-all-text="Semua"
    					items-per-page-text="Tampilkan"
    					page-text-locale="id"
    					add-new-uri="{{ route('agent-property.create') }}"
    					add-new-text="Tambah"
    					add-new-color="light-blue lighten-2"
    					edit-uri="agent-property.edit"
    					edit-uri-parameter="slug"
    					edit-text="Ubah"
    					delete-uri="agent-property.destroy"
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
