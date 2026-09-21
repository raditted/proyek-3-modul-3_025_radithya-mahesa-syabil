<label for="title">Judul</label><br>
<input id="title" name="title" value="{{ old('title', $activity->title ?? '') }}"><br>
@error('title')
	<p class="error">{{ $message }}</p>
@enderror
<br>

<label for="description">Deskripsi</label><br>
<textarea id="description" name="description">{{ old('description', $activity->description ?? '') }}</textarea><br>
@error('description')
	<p class="error">{{ $message }}</p>
@enderror
<br>

<label for="activity_date">Tanggal Kegiatan</label><br>
<input type="date" id="activity_date" name="activity_date" value="{{ old('activity_date', isset($activity) ? $activity->activity_date->format('Y-m-d') : '') }}"><br>
@error('activity_date')
	<p class="error">{{ $message }}</p>
@enderror
<br>

<label for="category">Kategori</label><br>
<input id="category" name="category" value="{{ old('category', $activity->category ?? '') }}"><br>
@error('category')
	<p class="error">{{ $message }}</p>
@enderror
<br>

<label for="status">Status</label><br>
<select name="status" id="status">
	@foreach (['Planned', 'Ongoing', 'Done'] as $status)
		<option value="{{ $status }}" @selected(old('status', $activity->status ?? 'Planned') === $status)>
			{{ $status }}
		</option>
	@endforeach
</select><br>
@error('status')
	<p class="error">{{ $message }}</p>
@enderror
<br>
