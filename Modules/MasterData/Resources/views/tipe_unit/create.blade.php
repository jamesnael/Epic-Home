@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<tipe-unit-form
	    				inline-template
                        :filter-tipe-proyek='@json($tipe_proyek)'
	    				action-form="{{ route('tipe-unit.store') }}"
	    				redirect-uri="{{ route('tipe-unit.index') }}">
		    			@include('masterdata::tipe_unit.form')
		    		</tipe-unit-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
