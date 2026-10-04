@extends('layouts.app')
@section('title', 'Contact | '.($settings['agency_name'] ?? 'Mountain Trails'))
@section('content')
<div class="relative overflow-hidden bg-forest pt-28">
  <img src="/images/hero.jpg" alt="Contact Mountain Trails" class="absolute inset-0 h-full w-full object-cover opacity-35">
  <div class="absolute inset-0 bg-gradient-to-t from-ink/80 via-ink/40 to-transparent"></div>
  <div class="container-shell relative py-16">
    <div class="max-w-2xl text-white">
      <p class="text-sm font-bold uppercase tracking-[0.2em] text-sand">Get in touch</p>
      <h1 class="mt-3 text-5xl">Plan your dream journey today.</h1>
      <p class="mt-4 text-white/75">Choose the quickest way to get package details, or send us your travel requirements. Every enquiry is saved securely in our JSON lead list.</p>
    </div>
  </div>
</div>

<section class="py-12">
  <div class="container-shell space-y-6">
    <div class="card flex flex-col gap-5 p-6 sm:flex-row sm:items-center sm:justify-between sm:p-7">
      <div class="flex items-start gap-4">
        <div class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-mist text-forest">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h2.3a1 1 0 01.95.68l1.1 3.2a1 1 0 01-.27 1.06l-1.4 1.4a12 12 0 005.2 5.2l1.4-1.4a1 1 0 011.06-.27l3.2 1.1a1 1 0 01.68.95V19a2 2 0 01-2 2h-1C9.7 21 3 14.3 3 6V5z"/></svg>
        </div>
        <div>
          <h2 class="text-2xl">Call Now</h2>
          <p class="mt-1 text-sm text-slate-500">Speak directly with our travel team for package guidance.</p>
        </div>
      </div>
      <a href="tel:{{ $settings['phone'] }}" class="btn-primary sm:w-auto">Call {{ $settings['phone'] }}</a>
    </div>

    <div class="card flex flex-col gap-5 p-6 sm:flex-row sm:items-center sm:justify-between sm:p-7">
      <div class="flex items-start gap-4">
        <div class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-mist text-forest">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8M8 14h5M7 4h10a2 2 0 012 2v12l-4-2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/></svg>
        </div>
        <div>
          <h2 class="text-2xl">Chat on WhatsApp</h2>
          <p class="mt-1 text-sm text-slate-500">Get package details with a pre-filled message.</p>
        </div>
      </div>
      @php $waText = 'Hello, I am interested in the '.($selected['name'] ?? 'travel packages').'. Please share more details.'; @endphp
      <a target="_blank" rel="noopener" href="https://wa.me/{{ $settings['whatsapp'] }}?text={{ urlencode($waText) }}" class="btn bg-sand text-ink sm:w-auto">Open WhatsApp</a>
    </div>

    <div class="card p-6 sm:p-8">
      <div class="flex items-start gap-4">
        <div class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-mist text-forest">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
        </div>
        <div>
          <h2 class="text-2xl">Send Enquiry</h2>
          <p class="mt-1 text-sm text-slate-500">Tell us what you need and we’ll get back to you.</p>
        </div>
      </div>

      @include('partials.enquiry-success')

      <form method="POST" action="{{ route('contact.store') }}" class="mt-6 grid gap-4 sm:grid-cols-2">
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
              <option value="{{ $package['slug'] }}" @selected(old('selected_package', $selected['slug'] ?? '') === $package['slug'])>{{ $package['name'] }}</option>
            @endforeach
          </select>
          @error('selected_package')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="text-sm font-semibold">Travellers *</label>
          <input type="number" min="1" max="50" name="travellers" value="{{ old('travellers', 1) }}" class="mt-1 w-full rounded-xl border-slate-200" required>
        </div>
        <div>
          <label class="text-sm font-semibold">Travel Date</label>
          <input type="date" name="travel_date" value="{{ old('travel_date') }}" class="mt-1 w-full rounded-xl border-slate-200">
        </div>
        <div class="sm:col-span-2">
          <label class="text-sm font-semibold">Message</label>
          <textarea name="message" rows="4" maxlength="1000" class="mt-1 w-full rounded-xl border-slate-200">{{ old('message') }}</textarea>
        </div>
        <div class="sm:col-span-2">
          <button class="btn-primary">Send Enquiry</button>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection
