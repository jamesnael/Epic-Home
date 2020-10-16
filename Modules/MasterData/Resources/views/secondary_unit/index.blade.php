@extends('core::layouts.master')

@push('table_slot')
<template v-slot:item.approved_status="{ item }">
    <v-chip
        :color="item.approved_status == 'Disetujui' ? 'green' : 'red'"
        text-color="white"
    >
        @{{ item.approved_status.toUpperCase() }}
    </v-chip>
</template>
<template v-slot:item.luas_tanah="{ item }">
    @{{ item.luas_tanah }} m<sup>2</sup>
</template>
<template v-slot:item.luas_bangunan="{ item }">
    @{{ item.luas_bangunan }} m<sup>2</sup>
</template>
@endpush


@section('content')
  

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
                        uri="{{ route('secondary-unit.table') }}"
                        :headers='@json($table_headers)'
                        no-data-text="Tidak ada data ditemukan."
                        no-results-text="Tidak ada data ditemukan."
                        search-text="Pencarian"
                        refresh-text="Muat Ulang"
                        items-per-page-all-text="Semua"
                        items-per-page-text="Tampilkan"
                        page-text-locale="id"
                        add-new-uri="{{ route('secondary-unit.create') }}"
                        add-new-text="Tambah"
                        add-new-color="light-blue lighten-2"
                        edit-uri="secondary-unit.edit"
                        edit-uri-parameter="id"
                        edit-text="Ubah"
                        delete-uri="secondary-unit.destroy"
                        delete-uri-parameter="id"
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
                        uri="{{ route('secondary-unit.table-approved') }}"
                        :headers='@json($table_headers)'
                        no-data-text="Tidak ada data ditemukan."
                        no-results-text="Tidak ada data ditemukan."
                        search-text="Pencarian"
                        refresh-text="Muat Ulang"
                        items-per-page-all-text="Semua"
                        items-per-page-text="Tampilkan"
                        page-text-locale="id"
                        add-new-uri="{{ route('secondary-unit.create') }}"
                        add-new-text="Tambah"
                        add-new-color="light-blue lighten-2"
                        edit-uri="secondary-unit.edit"
                        edit-uri-parameter="id"
                        edit-text="Ubah"
                        delete-uri="secondary-unit.destroy"
                        delete-uri-parameter="id"
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
