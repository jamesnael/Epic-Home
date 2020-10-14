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
    					action-form="{{ route('titip-jual-sewa.store') }}"
    					redirect-uri="{{ route('titip-jual-sewa.index') }}">
    					@include('transaksi::titip_jual_sewa.form')
					</titip-jual-sewa-form>
				</v-card-text>
			</v-card>
		</v-col>
	</v-row>
@endsection
