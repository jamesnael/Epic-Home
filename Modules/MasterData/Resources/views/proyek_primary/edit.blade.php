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

@section('scripts')
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbEzICmcP-W38WP-1GQpAZ7ZVPAakGYr0" async defer></script>
@endsection