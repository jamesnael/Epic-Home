@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<transaksi-form
	    				inline-template
	    				action-form="{{ route('transaksi-pemesanan.update', [ $data->slug ]) }}"
	    				redirect-primary="{{ route('transaksi-proyek-primary.index') }}"
	    				redirect-secondary="{{ route('transaksi-secondary-unit.index') }}"
	    				data-uri="{{ route('transaksi-pemesanan.data', [ $data->slug ]) }}">
		    			@include('transaksi::transaksi.form')
		    		</transaksi-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
