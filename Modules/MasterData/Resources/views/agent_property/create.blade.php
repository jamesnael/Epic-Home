@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<agent-property-form
	    				inline-template
	    				action-form="{{ route('agent-property.store') }}"
	    				redirect-uri="{{ route('agent-property.index') }}">
		    			@include('masterdata::agent_property.form')
		    		</agent-property-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
