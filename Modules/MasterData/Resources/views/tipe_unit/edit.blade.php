@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<tipe-unit-form
	    				inline-template
	    				action-form="{{ route('tipe-unit.update', [ $data->slug ]) }}"
	    				:filter-proyek-primary='@json($proyek_primary)'
	    				redirect-uri="{{ route('tipe-unit.index') }}"
	    				data-uri="{{ route('tipe-unit.data', [ $data->slug ]) }}">
		    			@include('masterdata::tipe_unit.form')
		    		</tipe-unit-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
