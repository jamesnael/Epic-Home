@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<secondary-unit-form
	    				inline-template
                        :filter-tipe-bangunan='@json($tipe_bangunan)'
                        :filter-jenis-pembayaran='@json($jenis_pembayaran)'
                        :filter-open-house='@json($open_house)'
                        :filter-sertifikat='@json($sertifikat)'
                        :filter-bersedia-dipasang='@json($bersedia_dipasang)'
                        :filter-status-unit='@json($status_unit)'
                        :filter-approved-status='@json($approved_status)'
                        :filter-kondisi-bangunan='@json($kondisi_bangunan)'
	    				action-form="{{ route('secondary-unit.store') }}"
	    				redirect-uri="{{ route('secondary-unit.index') }}">
		    			@include('masterdata::secondary_unit.form')
		    		</secondary-unit-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection