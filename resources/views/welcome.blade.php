<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="flex justify-center items-center flex-col min-h-screen bg-gray-100">
        <img src="{{ asset('evernight.gif') }}" alt="evernight_gif" width="50">
        <h1>hit the button to:</h1>
        <a href="/activities" class="bg-rose-500 hover:bg-rose-600 text-white font-bold py-2 px-4 rounded">
            /activities
        </a>
    </div>
</body>
</html>
