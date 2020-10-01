@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<tipe-proyek-form
	    				inline-template
	    				action-form="{{ route('tipe-proyek.store') }}"
	    				redirect-uri="{{ route('tipe-proyek.index') }}"
	    				data-uri="{{ route('tipe-proyek.data', [ $data->slug ]) }}">
		    			@include('masterdata::tipe_proyek.form')
		    		</tipe-proyek-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
