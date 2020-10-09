@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<customer-form
	    				inline-template
	    				action-form="{{ route('customer.store') }}"
	    				redirect-uri="{{ route('customer.index') }}">
		    			@include('masterdata::customer.form')
		    		</customer-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
