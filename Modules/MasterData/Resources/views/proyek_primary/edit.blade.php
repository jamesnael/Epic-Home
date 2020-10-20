@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<proyek-primary-form
	    				inline-template
	    				:filter-tipe-proyek='@json($tipe_proyek)'
                        :filter-tipe-bangunan='@json($tipe_bangunan)'
                        :filter-developer='@json($developer)'
                        :filter-status-unit='@json($status_unit)'
                        :filter-jenis-pembayaran='@json($jenis_pembayaran)'
	    				action-form="{{ route('proyek-primary.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('proyek-primary.index') }}"
	    				data-uri="{{ route('proyek-primary.data', [ $data->slug ]) }}">
		    			@include('masterdata::proyek_primary.form')
		    		</proyek-primary-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection