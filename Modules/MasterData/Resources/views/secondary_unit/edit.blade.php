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
	    				action-form="{{ route('secondary-unit.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('secondary-unit.index') }}"
	    				data-uri="{{ route('secondary-unit.data', [ $data->slug ]) }}">
		    			@include('masterdata::secondary_unit.form')
		    		</secondary-unit-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
