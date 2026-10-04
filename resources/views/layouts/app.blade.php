<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', $settings['agency_name'] ?? 'Mountain Trails')</title>
  <meta name="description" content="{{ $settings['hero_description'] ?? 'Mountain travel packages and enquiry support.' }}">
  <meta property="og:title" content="{{ $settings['agency_name'] ?? 'Mountain Trails' }} | Mountain Travel Packages">
  <meta property="og:description" content="{{ $settings['hero_description'] ?? '' }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="absolute inset-x-0 top-0 z-30">
  <div class="container-shell flex h-20 items-center justify-between">
    <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-white">{{ $settings['agency_name'] ?? 'Mountain Trails' }}</a>
    <button data-menu-button class="rounded-full bg-white/10 px-4 py-2 text-white md:hidden" aria-label="Open menu">Menu</button>
    <nav class="hidden items-center gap-7 text-sm font-semibold text-white md:flex">
      <a href="{{ route('home') }}#home" class="hover:text-sand">Home</a>
      <a href="{{ route('home') }}#packages" class="hover:text-sand">Packages</a>
      <a href="{{ route('home') }}#contact" class="hover:text-sand">Contact</a>
      <a href="tel:{{ $settings['phone'] ?? '' }}" class="btn bg-white/15 text-white ring-1 ring-white/30 hover:bg-white hover:text-forest">Call</a>
      <a href="https://wa.me/{{ $settings['whatsapp'] ?? '' }}" class="btn bg-sand text-ink hover:-translate-y-0.5" target="_blank" rel="noopener">WhatsApp</a>
    </nav>
  </div>
  <nav data-mobile-menu class="container-shell hidden pb-4 md:hidden">
    <div class="rounded-2xl bg-white p-4 shadow-xl">
      <a class="block rounded-xl px-4 py-3" href="{{ route('home') }}#home">Home</a>
      <a class="block rounded-xl px-4 py-3" href="{{ route('home') }}#packages">Packages</a>
      <a class="block rounded-xl px-4 py-3" href="{{ route('home') }}#contact">Contact</a>
      <div class="mt-2 flex gap-2"><a class="btn-primary flex-1" href="tel:{{ $settings['phone'] ?? '' }}">Call</a><a class="btn bg-sand flex-1" href="https://wa.me/{{ $settings['whatsapp'] ?? '' }}">WhatsApp</a></div>
    </div>
  </nav>
</header>
@yield('content')
<footer class="bg-ink py-12 text-white">
  <div class="container-shell grid gap-8 md:grid-cols-3">
    <div><div class="text-xl font-bold">{{ $settings['agency_name'] ?? 'Mountain Trails' }}</div><p class="mt-3 max-w-sm text-sm leading-6 text-white/60">Simple, thoughtful mountain journeys with quick support from enquiry to planning.</p></div>
    <div><div class="font-bold">Contact</div><div class="mt-3 space-y-2 text-sm text-white/70"><div>{{ $settings['phone'] ?? '' }}</div><div>{{ $settings['email'] ?? '' }}</div><div>{{ $settings['address'] ?? '' }}</div></div></div>
    <div><div class="font-bold">Start planning</div><p class="mt-3 text-sm text-white/60">Call or WhatsApp our travel team for package details.</p><div class="mt-4 flex gap-2"><a class="btn bg-white text-ink" href="tel:{{ $settings['phone'] ?? '' }}">Call Now</a><a class="btn bg-sand text-ink" href="https://wa.me/{{ $settings['whatsapp'] ?? '' }}">WhatsApp</a></div></div>
  </div>
  <div class="container-shell mt-10 border-t border-white/10 pt-6 text-xs text-white/40">© {{ date('Y') }} {{ $settings['agency_name'] ?? 'Mountain Trails' }}. All rights reserved.</div>
</footer>
</body>
</html>
