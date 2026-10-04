@extends('layouts.app')
@section('title', ($settings['agency_name'] ?? 'Mountain Trails').' | '.($settings['tagline'] ?? 'Mountain Travel Packages'))
@section('content')

{{-- Hero carousel inspired by R Travel --}}
<section id="home" class="relative min-h-[100vh] overflow-hidden bg-forest" data-hero-slider>
  @foreach(($settings['hero_slides'] ?? []) as $index => $slide)
  <div class="hero-slide {{ $index === 0 ? 'is-active' : '' }}" data-hero-slide>
    <img src="{{ $slide['image'] }}" alt="{{ $slide['title'] }}" class="absolute inset-0 h-full w-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/45 to-ink/20"></div>
  </div>
  @endforeach

  <div class="container-shell relative z-10 flex min-h-[100vh] items-end pb-20 pt-28">
    <div class="max-w-3xl text-white fade-up">
      <p class="text-2xl font-bold tracking-tight sm:text-3xl">{{ $settings['agency_name'] ?? 'Mountain Trails' }}</p>
      <p class="mt-2 text-sm font-semibold uppercase tracking-[0.22em] text-sand/90" data-hero-eyebrow>
        {{ $settings['hero_slides'][0]['eyebrow'] ?? 'Mountain escapes' }}
      </p>
      <h1 class="mt-5 text-5xl leading-[1.02] sm:text-6xl lg:text-7xl" data-hero-title>
        {{ $settings['hero_slides'][0]['title'] ?? ($settings['hero_title'] ?? 'Explore The Mountains') }}
      </h1>
      <p class="mt-4 text-lg text-white/85" data-hero-subtitle>
        {{ $settings['hero_slides'][0]['subtitle'] ?? '' }}
      </p>
      <p class="mt-5 max-w-2xl text-base leading-8 text-white/70" data-hero-description>
        {{ $settings['hero_slides'][0]['description'] ?? ($settings['hero_description'] ?? '') }}
      </p>
      <div class="mt-8 flex flex-wrap gap-3">
        <a href="#packages" class="btn bg-sand text-ink">Explore Tours</a>
        <a href="{{ route('contact') }}" class="btn border border-white/30 bg-white/10 text-white">Contact Us</a>
      </div>
      <div class="mt-10 flex gap-2" data-hero-dots>
        @foreach(($settings['hero_slides'] ?? []) as $index => $slide)
          <button type="button" class="h-2.5 w-2.5 rounded-full {{ $index === 0 ? 'bg-sand' : 'bg-white/40' }}" data-hero-dot="{{ $index }}" aria-label="Show slide {{ $index + 1 }}"></button>
        @endforeach
      </div>
    </div>
  </div>
</section>

{{-- Signature packages inspired by both sites --}}
<section id="packages" class="py-20 sm:py-24">
  <div class="container-shell">
    <div class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
      <div>
        <p class="section-eyebrow">Our Signature Packages</p>
        <h2 class="mt-2 text-4xl sm:text-5xl">Curated Experiences</h2>
      </div>
      <p class="max-w-md text-slate-500">Explore carefully crafted domestic tours across India’s most stunning mountain regions. Enquire for day-wise details.</p>
    </div>

    <div class="mt-10 grid gap-6 lg:grid-cols-3">
      @foreach($packages as $package)
      <article class="card group overflow-hidden">
        <div class="relative h-64 overflow-hidden">
          <img src="{{ $package['image'] }}" alt="{{ $package['name'] }} destination" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
        </div>
        <div class="p-6">
          <div class="flex items-center justify-between gap-3 text-xs font-semibold text-slate-500">
            <span>{{ $package['duration'] }}</span>
            <span class="text-forest">★ {{ $package['rating'] ?? '5.0' }}</span>
          </div>
          <div class="mt-3 flex items-start justify-between gap-4">
            <h3 class="text-2xl">{{ $package['name'] }}</h3>
            <div class="whitespace-nowrap text-right">
              @if(!empty($package['old_price']))
                <div class="text-xs text-slate-400 line-through">{{ $package['old_price'] }}</div>
              @endif
              <div class="font-bold text-forest">{{ $package['price'] }}</div>
            </div>
          </div>
          <p class="mt-3 text-sm leading-6 text-slate-500">{{ $package['short_description'] }}</p>
          <div class="mt-5 flex flex-wrap gap-2">
            @foreach($package['highlights'] as $highlight)
              <span class="rounded-full bg-mist px-3 py-1 text-xs font-semibold text-forest">{{ $highlight }}</span>
            @endforeach
          </div>
          <a href="{{ route('contact', ['package' => $package['slug']]) }}" class="btn-primary mt-6 w-full">Enquire Now</a>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>

{{-- About inspired by R Travel --}}
<section id="about" class="bg-mist py-20 sm:py-24">
  <div class="container-shell grid gap-10 lg:grid-cols-2 lg:items-center">
    <div>
      <p class="section-eyebrow">About {{ $settings['agency_name'] ?? 'Mountain Trails' }}</p>
      <h2 class="mt-2 text-4xl leading-tight sm:text-5xl">{{ $settings['about_title'] ?? 'Your Journey, Our Responsibility' }}</h2>
      <p class="mt-5 text-base leading-8 text-slate-600">{{ $settings['about_text'] ?? '' }}</p>
      <p class="mt-4 text-base leading-8 text-slate-600">{{ $settings['about_extra'] ?? '' }}</p>
      <div class="mt-8 grid gap-4 sm:grid-cols-3">
        @foreach(($settings['stats'] ?? []) as $stat)
          <div class="rounded-3xl bg-white p-5">
            <div class="text-3xl font-bold text-forest">{{ $stat['value'] }}</div>
            <p class="mt-2 text-sm text-slate-500">{{ $stat['label'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
    <div class="space-y-5">
      <div class="rounded-[2rem] bg-forest p-8 text-white">
        <p class="text-sm font-bold uppercase tracking-[0.2em] text-sand">Our Vision</p>
        <p class="mt-4 text-lg leading-8 text-white/85">{{ $settings['vision'] ?? '' }}</p>
        <p class="mt-6 text-sm text-white/60">Quality · Honest Guidance · Best Pricing</p>
      </div>
      <div class="overflow-hidden rounded-[2rem]">
        <img src="/images/hero.jpg" alt="Mountain travel landscape" class="h-72 w-full object-cover">
      </div>
    </div>
  </div>
</section>

{{-- Services inspired by R Travel --}}
<section id="services" class="py-20 sm:py-24">
  <div class="container-shell">
    <div class="max-w-2xl">
      <p class="section-eyebrow">What We Do</p>
      <h2 class="mt-2 text-4xl sm:text-5xl">Our Services</h2>
      <p class="mt-4 text-slate-500">From customized domestic packages to end-to-end travel assistance, we help you plan better and travel with confidence.</p>
    </div>
    <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
      @foreach(($settings['services'] ?? []) as $service)
        <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-soft transition hover:-translate-y-1 hover:shadow-lg">
          <div class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-mist text-forest">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
          </div>
          <h3 class="mt-5 text-xl">{{ $service['title'] }}</h3>
          <p class="mt-2 text-sm leading-6 text-slate-500">{{ $service['description'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Why choose us inspired by Blink My Trip --}}
<section class="bg-mist py-20">
  <div class="container-shell">
    <div class="max-w-xl">
      <p class="section-eyebrow">Why choose us</p>
      <h2 class="mt-2 text-4xl sm:text-5xl">Trust Our Experience</h2>
    </div>
    <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      @foreach(($settings['why_choose'] ?? []) as $item)
        <div class="rounded-3xl bg-white p-6">
          <h3 class="text-xl">{{ $item['title'] }}</h3>
          <p class="mt-2 text-sm leading-6 text-slate-500">{{ $item['description'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Destinations inspired by R Travel --}}
<section id="destinations" class="py-20 sm:py-24">
  <div class="container-shell">
    <div class="flex flex-col justify-between gap-5 md:flex-row md:items-end">
      <div>
        <p class="section-eyebrow">Where We Take You</p>
        <h2 class="mt-2 text-4xl sm:text-5xl">Top Destinations</h2>
      </div>
      <p class="max-w-md text-slate-500">Explore India’s most loved mountain regions with packages built for comfort, scenery and easy planning.</p>
    </div>
    <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
      @foreach(($settings['destinations'] ?? []) as $destination)
        <a href="#packages" class="group relative block overflow-hidden rounded-[1.75rem]">
          <img src="{{ $destination['image'] }}" alt="{{ $destination['name'] }}" class="h-72 w-full object-cover transition duration-500 group-hover:scale-105">
          <div class="absolute inset-0 bg-gradient-to-t from-ink/80 via-ink/20 to-transparent"></div>
          <div class="absolute inset-x-0 bottom-0 p-6 text-white">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-sand">{{ $destination['tagline'] }}</p>
            <h3 class="mt-2 text-3xl">{{ $destination['name'] }}</h3>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>

{{-- Testimonials inspired by Blink My Trip --}}
<section class="bg-mist py-20">
  <div class="container-shell">
    <div class="max-w-xl">
      <p class="section-eyebrow">What travellers say</p>
      <h2 class="mt-2 text-4xl sm:text-5xl">First-class impressions</h2>
    </div>
    <div class="mt-10 grid gap-5 lg:grid-cols-3">
      @foreach(($settings['testimonials'] ?? []) as $item)
        <div class="rounded-3xl bg-white p-7 shadow-soft">
          <div class="text-sand">★★★★★</div>
          <p class="mt-4 text-sm leading-7 text-slate-600">“{{ $item['text'] }}”</p>
          <p class="mt-5 font-bold text-forest">{{ $item['name'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

{{-- Contact CTA + enquiry form inspired by R Travel --}}
<section id="contact" class="py-20 sm:py-24">
  <div class="container-shell grid gap-8 lg:grid-cols-2">
    <div class="overflow-hidden rounded-[2rem] bg-forest px-7 py-12 text-white sm:px-10">
      <p class="text-sm font-bold uppercase tracking-[0.2em] text-sand">Get In Touch</p>
      <h2 class="mt-3 text-4xl sm:text-5xl">Plan Your Dream Journey Today</h2>
      <p class="mt-4 text-white/70">Whether you need a custom holiday package or help choosing the right mountain itinerary, we handle the planning so you can travel with confidence.</p>
      <div class="mt-8 space-y-4 text-sm text-white/80">
        <div><span class="block text-xs uppercase tracking-wider text-white/50">Phone</span>{{ $settings['phone'] ?? '' }}</div>
        <div><span class="block text-xs uppercase tracking-wider text-white/50">Email</span>{{ $settings['email'] ?? '' }}</div>
        <div><span class="block text-xs uppercase tracking-wider text-white/50">Office</span>{{ $settings['address'] ?? '' }}</div>
      </div>
      <div class="mt-8 flex flex-wrap gap-3">
        <a class="btn bg-sand text-ink" href="tel:{{ $settings['phone'] ?? '' }}">Call Now</a>
        <a class="btn border border-white/20 bg-white/10 text-white" href="https://wa.me/{{ $settings['whatsapp'] ?? '' }}" target="_blank" rel="noopener">Chat on WhatsApp</a>
      </div>
    </div>

    <div class="card p-7 sm:p-8">
      <h3 class="text-3xl">Package Enquiry</h3>
      <p class="mt-2 text-sm text-slate-500">Send your travel requirements — we’ll save your enquiry and get back to you.</p>
      @include('partials.enquiry-success')
      <form method="POST" action="{{ route('contact.store') }}" class="mt-6 space-y-4">
        @csrf
        <div>
          <label class="text-sm font-semibold">Full Name *</label>
          <input name="full_name" value="{{ old('full_name') }}" class="mt-1 w-full rounded-xl border-slate-200" required>
          @error('full_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="text-sm font-semibold">Phone Number *</label>
          <input name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-xl border-slate-200" required>
          @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="text-sm font-semibold">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-xl border-slate-200">
        </div>
        <div>
          <label class="text-sm font-semibold">Selected Package *</label>
          <select name="selected_package" class="mt-1 w-full rounded-xl border-slate-200" required>
            <option value="">Choose a package</option>
            @foreach($packages as $package)
              <option value="{{ $package['slug'] }}" @selected(old('selected_package') === $package['slug'])>{{ $package['name'] }}</option>
            @endforeach
          </select>
          @error('selected_package')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="text-sm font-semibold">Travellers *</label>
            <input type="number" min="1" max="50" name="travellers" value="{{ old('travellers', 1) }}" class="mt-1 w-full rounded-xl border-slate-200" required>
          </div>
          <div>
            <label class="text-sm font-semibold">Travel Date</label>
            <input type="date" name="travel_date" value="{{ old('travel_date') }}" class="mt-1 w-full rounded-xl border-slate-200">
          </div>
        </div>
        <div>
          <label class="text-sm font-semibold">Additional Message</label>
          <textarea name="message" rows="3" maxlength="1000" class="mt-1 w-full rounded-xl border-slate-200">{{ old('message') }}</textarea>
        </div>
        <button class="btn-primary w-full">Send Package Enquiry</button>
      </form>
    </div>
  </div>
</section>

<script>
  window.__heroSlides = @json($settings['hero_slides'] ?? []);
</script>
@endsection
