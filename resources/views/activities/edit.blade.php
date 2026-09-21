@extends('layouts.app')

@section('content')
	<h1>Edit Kegiatan</h1>
	<form action="{{ route('activities.update', $activity) }}" method="POST">
		@csrf
		@method('PUT')
		@include('activities._form')
		<button type="submit">Perbarui</button>
	</form>
@endsection