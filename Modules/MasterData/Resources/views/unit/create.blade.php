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
                        :filter-cluster='@json($cluster)'
                        :filter-tipe-unit='@json($tipe_unit)'
	    				action-form="{{ route('proyek-primary.unit.store', [$proyek_primary->slug]) }}"
	    				redirect-uri="{{ route('proyek-primary.unit.index', [$proyek_primary->slug]) }}">
		    			@include('masterdata::unit.form')
		    		</unit-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
