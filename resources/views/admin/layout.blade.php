<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>@yield('title') · Admin</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-mist">
<header class="border-b border-slate-200 bg-white">
  <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4">
    <a href="{{ route('admin.dashboard') }}" class="font-bold text-forest">Mountain Trails · Admin</a>
    <div class="flex items-center gap-4">
      <a class="text-sm font-semibold text-slate-600" href="{{ route('admin.enquiries.index') }}">Enquiries</a>
      <a class="text-sm font-semibold text-slate-600" href="{{ route('admin.json.index') }}">JSON Data</a>
      <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="text-sm font-semibold text-red-600">Logout</button></form>
    </div>
  </div>
</header>
<main class="mx-auto max-w-7xl px-5 py-8">@yield('content')</main>
</body>
</html>
