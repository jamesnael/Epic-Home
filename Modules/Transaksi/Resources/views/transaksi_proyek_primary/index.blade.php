@extends('core::layouts.master')

@push('table_slot')
<template v-slot:item.harga_unit="{ item }">
       Rp @{{ number_format(item.harga_unit) }}
    </span>
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
                                uri="{{ route('transaksi-proyek-primary.table') }}"
                                :headers='@json($table_headers)'
                                no-data-text="Tidak ada data ditemukan."
                                no-results-text="Tidak ada data ditemukan."
                                search-text="Pencarian"
                                refresh-text="Muat Ulang"
                                items-per-page-all-text="Semua"
                                items-per-page-text="Tampilkan"
                                page-text-locale="id"
                                edit-uri="transaksi-proyek-primary.edit"
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
                            uri="{{ route('transaksi-proyek-primary-bayar.table') }}"
                            :headers='@json($table_headers)'
                            no-data-text="Tidak ada data ditemukan."
                            no-results-text="Tidak ada data ditemukan."
                            search-text="Pencarian"
                            refresh-text="Muat Ulang"
                            items-per-page-all-text="Semua"
                            items-per-page-text="Tampilkan"
                            page-text-locale="id"
                            edit-uri="transaksi-proyek-primary.edit"
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
