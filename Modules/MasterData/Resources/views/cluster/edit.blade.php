@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<cluster-form
	    				inline-template
	    				action-form="{{ route('cluster.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('cluster.index') }}"
	    				data-uri="{{ route('cluster.data', [ $data->slug ]) }}">
		    			@include('masterdata::cluster.form')
		    		</cluster-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
