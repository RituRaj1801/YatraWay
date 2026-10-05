<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'WingsYourTrip')</title>

    <meta name="description"
        content="WingsYourTrip offers Himachal and Manali tour packages from Delhi, customized family holidays, honeymoon trips and mountain tours across Himachal Pradesh and Uttarakhand.">
    <link rel="canonical" href="{{ url('/') }}">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="{{ $settings['agency_name'] ?? 'Mountain Trails' }} | Mountain Travel Packages">
    <meta property="og:description" content="{{ $settings['hero_description'] ?? '' }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script type="application/ld+json">
        {!! json_encode([
            '@@context' => 'https://schema.org',
            '@type' => 'TravelAgency',
            'name' => 'WingsYourTrip',
            'url' => url('/'),
            "logo"=> "https://wingsyourtrip.com/images/logo.png",
            "description"=> "Explore Himachal, Manali and Uttarakhand tour packages with WingsYourTrip. Discover customized holidays, family trips, honeymoon packages and mountain adventures across India."
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
    </script>
</head>

<body>
    <header class="absolute inset-x-0 top-0 z-30">
        <div class="container-shell flex h-20 items-center justify-between">
            <a href="{{ route('home') }}"
                class="text-xl font-bold tracking-tight text-white">{{ $settings['agency_name'] ?? 'Mountain Trails' }}</a>
            <button data-menu-button class="rounded-full bg-white/10 px-4 py-2 text-white md:hidden"
                aria-label="Open menu">Menu</button>
            <nav class="hidden items-center gap-7 text-sm font-semibold text-white md:flex">
                <a href="{{ route('home') }}#home" class="hover:text-sand">Home</a>
                <a href="{{ route('home') }}#about" class="hover:text-sand">About Us</a>
                <a href="{{ route('home') }}#packages" class="hover:text-sand">Tours / Packages</a>
                <a href="{{ route('home') }}#services" class="hover:text-sand">Services</a>
                <a href="{{ route('home') }}#destinations" class="hover:text-sand">Destinations</a>
                <a href="{{ route('contact') }}" class="hover:text-sand">Contact Us</a>
                <a href="tel:{{ $settings['phone'] ?? '' }}"
                    class="btn bg-white/15 text-white ring-1 ring-white/30 hover:bg-white hover:text-forest">{{ $settings['phone'] ?? 'Call' }}</a>
                <a href="https://wa.me/{{ $settings['whatsapp'] ?? '' }}"
                    class="btn bg-sand text-ink hover:-translate-y-0.5" target="_blank" rel="noopener">Talk to us</a>
            </nav>
        </div>
        <nav data-mobile-menu class="container-shell hidden pb-4 md:hidden">
            <div class="rounded-2xl bg-white p-4 shadow-xl">
                <a class="block rounded-xl px-4 py-3" href="{{ route('home') }}#home">Home</a>
                <a class="block rounded-xl px-4 py-3" href="{{ route('home') }}#about">About Us</a>
                <a class="block rounded-xl px-4 py-3" href="{{ route('home') }}#packages">Tours / Packages</a>
                <a class="block rounded-xl px-4 py-3" href="{{ route('home') }}#services">Services</a>
                <a class="block rounded-xl px-4 py-3" href="{{ route('home') }}#destinations">Destinations</a>
                <a class="block rounded-xl px-4 py-3" href="{{ route('contact') }}">Contact Us</a>
                <div class="mt-2 flex gap-2">
                    <a class="btn-primary flex-1" href="tel:{{ $settings['phone'] ?? '' }}">Call</a>
                    <a class="btn bg-sand flex-1" href="https://wa.me/{{ $settings['whatsapp'] ?? '' }}">WhatsApp</a>
                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer class="bg-ink py-14 text-white">
        <div class="container-shell grid gap-10 md:grid-cols-4">
            <div class="md:col-span-2">
                <div class="text-2xl font-bold">{{ $settings['agency_name'] ?? 'Mountain Trails' }}</div>
                <p class="mt-3 max-w-md text-sm leading-7 text-white/60">
                    {{ $settings['tagline'] ?? 'Your trusted travel partner for crafting unforgettable mountain journeys.' }}
                </p>
                <p class="mt-4 max-w-md text-sm leading-7 text-white/50">We offer customized domestic holiday packages
                    and hassle-free travel planning services.</p>
            </div>
            <div>
                <div class="font-bold">Explore</div>
                <div class="mt-4 space-y-2 text-sm text-white/70">
                    <a class="block hover:text-sand" href="{{ route('home') }}#about">About Us</a>
                    <a class="block hover:text-sand" href="{{ route('home') }}#packages">Packages</a>
                    <a class="block hover:text-sand" href="{{ route('home') }}#services">Services</a>
                    <a class="block hover:text-sand" href="{{ route('contact') }}">Contact</a>
                </div>
            </div>
            <div>
                <div class="font-bold">Contact Us</div>
                <div class="mt-4 space-y-2 text-sm text-white/70">
                    <div>{{ $settings['phone'] ?? '' }}</div>
                    <div>{{ $settings['email'] ?? '' }}</div>
                    <div>{{ $settings['address'] ?? '' }}</div>
                </div>
                <div class="mt-5 flex flex-wrap gap-2">
                    <a class="btn bg-white text-ink" href="tel:{{ $settings['phone'] ?? '' }}">Call Now</a>
                    <a class="btn bg-sand text-ink" href="https://wa.me/{{ $settings['whatsapp'] ?? '' }}"
                        target="_blank" rel="noopener">WhatsApp</a>
                </div>
            </div>
        </div>
        <div class="container-shell mt-10 border-t border-white/10 pt-6 text-xs text-white/40">
            © {{ date('Y') }} {{ $settings['agency_name'] ?? 'Mountain Trails' }}. All rights reserved.
        </div>
    </footer>
</body>

</html>
