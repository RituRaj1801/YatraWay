@extends('admin.layout')
@section('title','Dashboard')
@section('content')
@if(session('success'))
<div class="mb-5 rounded-2xl bg-mist p-4 text-sm font-semibold text-forest">{{ session('success') }}</div>
@endif

{{-- Stat cards with icons --}}
<div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">
  <div class="card p-6">
    <div class="flex items-start justify-between gap-3">
      <div>
        <p class="text-sm text-slate-500">Total Enquiries</p>
        <p class="mt-2 text-4xl font-bold">{{ $total }}</p>
      </div>
      <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-mist text-forest">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8M8 14h5M7 4h10a2 2 0 012 2v12l-4-2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/></svg>
      </span>
    </div>
  </div>

  <div class="card p-6">
    <div class="flex items-start justify-between gap-3">
      <div>
        <p class="text-sm text-slate-500">Himachal Enquiries</p>
        <p class="mt-2 text-4xl font-bold">{{ $himachal }}</p>
      </div>
      <img src="/images/packages/himachal.jpg" alt="Himachal" class="h-12 w-12 rounded-2xl object-cover">
    </div>
  </div>

  <div class="card p-6">
    <div class="flex items-start justify-between gap-3">
      <div>
        <p class="text-sm text-slate-500">Uttarakhand Enquiries</p>
        <p class="mt-2 text-4xl font-bold">{{ $uttarakhand }}</p>
      </div>
      <img src="/images/packages/uttarakhand.jpg" alt="Uttarakhand" class="h-12 w-12 rounded-2xl object-cover">
    </div>
  </div>

  <div class="card p-6">
    <div class="flex items-start justify-between gap-3">
      <div>
        <p class="text-sm text-slate-500">Manali Enquiries</p>
        <p class="mt-2 text-4xl font-bold">{{ $manali }}</p>
      </div>
      <img src="/images/packages/manali.jpg" alt="Manali" class="h-12 w-12 rounded-2xl object-cover">
    </div>
  </div>
</div>

{{-- Packages overview + quick add form --}}
<div class="mt-8 grid gap-6 xl:grid-cols-5">
  <div class="card p-6 xl:col-span-2">
    <div class="flex items-center gap-3">
      <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-mist text-forest">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9-4 9 4-9 4-9-4zm0 5l9 4 9-4M3 17l9 4 9-4"/></svg>
      </span>
      <div>
        <h2 class="text-2xl">Active packages</h2>
        <p class="text-sm text-slate-500">Loaded from packages.json</p>
      </div>
    </div>

    <div class="mt-6 space-y-4">
      @foreach($packages as $package)
      <div class="flex items-center gap-4 rounded-2xl border border-slate-100 p-3">
        <img src="{{ $package['image'] }}" alt="{{ $package['name'] }}" class="h-14 w-14 rounded-xl object-cover">
        <div class="min-w-0 flex-1">
          <p class="truncate font-semibold">{{ $package['name'] }}</p>
          <p class="text-xs text-slate-500">{{ $package['duration'] }} · {{ $package['price'] }}</p>
        </div>
      </div>
      @endforeach
    </div>

    <div class="mt-6 rounded-2xl bg-mist p-4">
      <p class="text-sm font-semibold text-forest">Manage leads</p>
      <p class="mt-1 text-sm text-slate-500">View, filter and manage incoming enquiries stored in JSON.</p>
      <a class="btn-primary mt-4" href="{{ route('admin.enquiries.index') }}">View Enquiries</a>
    </div>
  </div>

  <div class="card p-6 xl:col-span-3">
    <div class="flex items-center gap-3">
      <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-mist text-forest">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
      </span>
      <div>
        <h2 class="text-2xl">Quick add enquiry</h2>
        <p class="text-sm text-slate-500">Submit below — data is saved into enquiries.json</p>
      </div>
    </div>

    <form method="POST" action="{{ route('admin.dashboard.enquiries.store') }}" class="mt-6 grid gap-4 sm:grid-cols-2">
      @csrf
      <div class="sm:col-span-1">
        <label class="text-sm font-semibold">Full Name *</label>
        <input name="full_name" value="{{ old('full_name') }}" class="mt-1 w-full rounded-xl border-slate-200" required>
        @error('full_name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
      </div>
      <div class="sm:col-span-1">
        <label class="text-sm font-semibold">Phone Number *</label>
        <input name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-xl border-slate-200" required>
        @error('phone')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
      </div>
      <div class="sm:col-span-1">
        <label class="text-sm font-semibold">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-xl border-slate-200">
        @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
      </div>
      <div class="sm:col-span-1">
        <label class="text-sm font-semibold">Selected Package *</label>
        <select name="selected_package" class="mt-1 w-full rounded-xl border-slate-200" required>
          <option value="">Choose a package</option>
          @foreach($packages as $package)
            <option value="{{ $package['slug'] }}" @selected(old('selected_package') === $package['slug'])>{{ $package['name'] }}</option>
          @endforeach
        </select>
        @error('selected_package')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="text-sm font-semibold">Travellers *</label>
        <input type="number" min="1" max="50" name="travellers" value="{{ old('travellers', 1) }}" class="mt-1 w-full rounded-xl border-slate-200" required>
        @error('travellers')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="text-sm font-semibold">Travel Date</label>
        <input type="date" name="travel_date" value="{{ old('travel_date') }}" class="mt-1 w-full rounded-xl border-slate-200">
        @error('travel_date')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
      </div>
      <div class="sm:col-span-2">
        <label class="text-sm font-semibold">Message</label>
        <textarea name="message" rows="3" maxlength="1000" class="mt-1 w-full rounded-xl border-slate-200">{{ old('message') }}</textarea>
        @error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
      </div>
      <div class="sm:col-span-2">
        <button class="btn-primary">Save Enquiry to JSON</button>
      </div>
    </form>
  </div>
</div>

{{-- Recent enquiries --}}
<div class="mt-8 card overflow-hidden">
  <div class="flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 p-6">
    <div class="flex items-center gap-3">
      <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-mist text-forest">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      </span>
      <div>
        <h2 class="text-2xl">Recent enquiries</h2>
        <p class="text-sm text-slate-500">Latest records from enquiries.json</p>
      </div>
    </div>
    <a class="btn-outline" href="{{ route('admin.enquiries.index') }}">See all</a>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full text-left text-sm">
      <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
        <tr>
          <th class="px-5 py-4">ID</th>
          <th class="px-5 py-4">Name</th>
          <th class="px-5 py-4">Package</th>
          <th class="px-5 py-4">Phone</th>
          <th class="px-5 py-4">Submitted</th>
          <th class="px-5 py-4">Action</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-slate-100">
        @forelse($recent as $enquiry)
        <tr>
          <td class="px-5 py-4 font-semibold">{{ $enquiry['id'] }}</td>
          <td class="px-5 py-4">{{ $enquiry['full_name'] }}</td>
          <td class="px-5 py-4">{{ $enquiry['selected_package'] }}</td>
          <td class="px-5 py-4">{{ $enquiry['phone'] }}</td>
          <td class="px-5 py-4">{{ $enquiry['created_at'] }}</td>
          <td class="px-5 py-4"><a class="font-semibold text-forest" href="{{ route('admin.enquiries.show', $enquiry['id']) }}">View</a></td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="px-5 py-12 text-center text-slate-500">No enquiries yet. Use the form above to add one.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
