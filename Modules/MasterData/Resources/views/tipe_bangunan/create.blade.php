@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<tipe-bangunan-form
	    				inline-template
	    				action-form="{{ route('tipe-bangunan.store') }}"
	    				redirect-uri="{{ route('tipe-bangunan.index') }}">
		    			@include('masterdata::tipe_bangunan.form')
		    		</tipe-bangunan-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
