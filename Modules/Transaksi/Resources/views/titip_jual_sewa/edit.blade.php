@extends('core::layouts.master')

@section('content')
    <v-row
	    class="px-md-4 px-sm-2">
    	<v-col cols="12">
    		<v-card>
    			<v-card-text>
    				<titip-jual-sewa-form
	    				inline-template
	    				:filter-tipe-bangunan='@json($tipe_bangunan)'
	    				:filter-status='@json($status)'
	    				:filter-kebutuhan='@json($kebutuhan)'
	    				action-form="{{ route('titip-jual-sewa.update', [ $data->slug ]) }}"
	    				redirect-uri="{{ route('titip-jual-sewa.index') }}"
	    				data-uri="{{ route('titip-jual-sewa.data', [ $data->slug ]) }}">
		    			@include('transaksi::titip_jual_sewa.form')
		    		</titip-jual-sewa-form>
			    </v-card-text>
    		</v-card>
    	</v-col>
    </v-row>
@endsection
