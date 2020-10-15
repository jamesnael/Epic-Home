@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<bank-form
	    				inline-template
	    				:filter-status='@json($status)'
                        :filter-jenis-bank='@json($jenis_bank)'
	    				action-form="{{ route('bank.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('bank.index') }}"
	    				data-uri="{{ route('bank.data', [ $data->slug ]) }}">
		    			@include('masterdata::bank.form')
		    		</bank-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
