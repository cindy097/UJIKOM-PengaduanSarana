<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'School Aspiration System' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-50 min-h-screen">

{{-- NAVBAR --}}
<nav class="bg-gradient-to-r from-orange-500 to-amber-500
            p-4 text-white flex justify-between items-center shadow">
    <span class="font-bold text-lg tracking-wide">
        School Aspiration
    </span>

    <a href="/logout"
       class="text-sm font-semibold hover:underline">
        Logout
    </a>
</nav>

{{-- CONTENT --}}
<div class="container mx-auto p-6">

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 mb-6 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</div>

</body>
</html>