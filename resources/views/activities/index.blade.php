@extends('layouts.app')

@section('content')
<h1>Daftar Kegiatan</h1>

<form action="{{ route('activities.index') }}" method="GET" style="margin-bottom: 20px;">
    <label for="status">Filter Status:</label>
    <select name="status" id="status" onchange="this.form.submit()">
        <option value="">Semua</option>
        <option value="Planned" @selected(request('status') === 'Planned')>Planned</option>
        <option value="Ongoing" @selected(request('status') === 'Ongoing')>Ongoing</option>
        <option value="Done" @selected(request('status') === 'Done')>Done</option>
    </select>
    <noscript><button type="submit">Filter</button></noscript>
</form>

    @forelse ($activities as $activity)
        <article @class(['card'])>
            <h2>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h2>
            <p>{{ $activity->activity_date->format('d M Y') }}</p>
            <p>{{ $activity->description }}</p>
            <p>Status: {{ $activity->status }}</p>
        </article>
        @empty
        <p>Belum ada kegiatan.</p>
    @endforelse
@endsection