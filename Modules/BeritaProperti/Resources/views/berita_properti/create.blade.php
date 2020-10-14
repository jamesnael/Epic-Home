@extends('core::layouts.master')

@section('content')
	<v-row
	    class="px-md-4 px-sm-2">
		<v-col cols="12">
			<v-card>
				<v-card-text>
					<berita-properti-form
    					inline-template
    					:filter-tag='@json($tag)'
    					action-form="{{ route('berita-properti.store') }}"
    					redirect-uri="{{ route('berita-properti.index') }}">
    					@include('beritaproperti::berita_properti.form')
					</berita-properti-form>
				</v-card-text>
			</v-card>
		</v-col>
	</v-row>
@endsection
