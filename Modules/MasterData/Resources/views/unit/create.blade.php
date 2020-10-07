@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<unit-form
	    				inline-template
                        :filter-proyek-primari='@json($proyek_primari)'
                        :filter-tipe-unit='@json($tipe_unit)'
                        :filter-cluster='@json($cluster)'
	    				action-form="{{ route('unit.store') }}"
	    				redirect-uri="{{ route('unit.index') }}">
		    			@include('masterdata::unit.form')
		    		</unit-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
