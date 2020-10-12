@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<customer-form
	    				inline-template
	    				action-form="{{ route('customer.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('customer.index') }}"
	    				data-uri="{{ route('customer.data', [ $data->slug ]) }}">
		    			@include('manageuser::customer.form')
		    		</customer-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
