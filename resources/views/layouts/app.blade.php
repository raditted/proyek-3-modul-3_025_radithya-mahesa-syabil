<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Manager</title>
    <style>
        .error { color: red; font-size: 0.9em; }
        .card { border: 1px solid #ccc; padding: 15px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <nav>
        <a href="{{ route('activities.index') }}">Daftar Kegiatan</a> | 
        <a href="{{ route('activities.create') }}">Tambah Kegiatan</a>
    </nav>
    <hr>
    
    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>
</body>
</html>