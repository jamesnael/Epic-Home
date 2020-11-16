@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<developer-form
	    				inline-template
	    				action-form="{{ route('developer.store') }}"
	    				redirect-uri="{{ route('developer.index') }}">
		    			@include('masterdata::developer.form')
		    		</developer-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
