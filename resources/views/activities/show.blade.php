@extends('layouts.app')

@section('content')
	<h1>{{ $activity->title }}</h1>
	<p><strong>Tanggal:</strong> {{ $activity->activity_date->format('d M Y') }}</p>
	<p><strong>Kategori:</strong> {{ $activity->category }}</p>
	<p><strong>Status:</strong> {{ $activity->status }}</p>
	<p><strong>Deskripsi:</strong> {{ $activity->description }}</p>

	<a href="{{ route('activities.edit', $activity) }}">Edit Kegiatan</a>

	<form action="{{ route('activities.destroy', $activity) }}" method="POST" style="margin-top: 10px;">
		@csrf
		@method('DELETE')
		<button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus Kegiatan</button>
	</form>
@endsection