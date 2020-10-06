@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<cluster-form
	    				inline-template
	    				action-form="{{ route('cluster.store') }}"
	    				redirect-uri="{{ route('cluster.index') }}">
		    			@include('masterdata::cluster.form')
		    		</cluster-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
