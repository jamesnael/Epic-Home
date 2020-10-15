@extends('core::layouts.master')

@push('table_slot')
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
                                uri="{{ route('transaksi-secondary-unit.table') }}"
                                :headers='@json($table_headers)'
                                no-data-text="Tidak ada data ditemukan."
                                no-results-text="Tidak ada data ditemukan."
                                search-text="Pencarian"
                                refresh-text="Muat Ulang"
                                items-per-page-all-text="Semua"
                                items-per-page-text="Tampilkan"
                                page-text-locale="id"
                                edit-uri="transaksi-secondary-unit.edit"
                                edit-uri-parameter="slug"
                                edit-text="Ubah"
                            >
                                
                                @include('core::components.table')
                            </table-component>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-tab-item>

        <v-tab>
            Bayar
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
                            uri="{{ route('transaksi-secondary-unit-bayar.table') }}"
                            :headers='@json($table_headers)'
                            no-data-text="Tidak ada data ditemukan."
                            no-results-text="Tidak ada data ditemukan."
                            search-text="Pencarian"
                            refresh-text="Muat Ulang"
                            items-per-page-all-text="Semua"
                            items-per-page-text="Tampilkan"
                            page-text-locale="id"
                            edit-uri="transaksi-secondary-unit.edit"
                            edit-uri-parameter="slug"
                            edit-text="Ubah"
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
