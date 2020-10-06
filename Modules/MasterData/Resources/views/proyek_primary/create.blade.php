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
                        :filter-tipe-unit='@json($tipe_unit)'
                        :filter-cluster='@json($cluster)'
	    				action-form="{{ route('proyek-primary.store') }}"
	    				redirect-uri="{{ route('proyek-primary.index') }}">
		    			@include('masterdata::proyek_primary.form')
		    		</proyek-primary-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
