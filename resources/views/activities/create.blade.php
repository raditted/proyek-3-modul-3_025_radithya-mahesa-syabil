@extends('layouts.app')

@section('content')
	<h1>Tambah Kegiatan</h1>
	<form action="{{ route('activities.store') }}" method="POST">
		@csrf
		@include('activities._form')
		<button type="submit">Simpan</button>
	</form>
@endsection