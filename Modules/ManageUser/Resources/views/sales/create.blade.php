@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<sales-form
	    				inline-template
	    				action-form="{{ route('sales.store') }}"
	    				redirect-uri="{{ route('sales.index') }}">
		    			@include('manageuser::sales.form')
		    		</sales-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
