@if(session('success'))
  <div class="mt-5 rounded-2xl bg-mist p-4 text-sm text-forest">
    <p class="font-semibold">{{ session('success') }}</p>
    @if(session('submitted_enquiry'))
      @php $info = session('submitted_enquiry'); @endphp
      <div class="mt-4 grid gap-2 border-t border-forest/10 pt-4 text-slate-700 sm:grid-cols-2">
        <div><span class="text-xs font-bold uppercase tracking-wider text-slate-400">Enquiry ID</span><p class="font-semibold">{{ $info['id'] ?? '—' }}</p></div>
        <div><span class="text-xs font-bold uppercase tracking-wider text-slate-400">Submitted</span><p class="font-semibold">{{ $info['created_at'] ?? '—' }}</p></div>
        <div><span class="text-xs font-bold uppercase tracking-wider text-slate-400">Full Name</span><p class="font-semibold">{{ $info['full_name'] ?? '—' }}</p></div>
        <div><span class="text-xs font-bold uppercase tracking-wider text-slate-400">Phone</span><p class="font-semibold">{{ $info['phone'] ?? '—' }}</p></div>
        <div><span class="text-xs font-bold uppercase tracking-wider text-slate-400">Email</span><p class="font-semibold">{{ $info['email'] ?: '—' }}</p></div>
        <div><span class="text-xs font-bold uppercase tracking-wider text-slate-400">Package</span><p class="font-semibold">{{ $info['selected_package'] ?? '—' }}</p></div>
        <div><span class="text-xs font-bold uppercase tracking-wider text-slate-400">Travellers</span><p class="font-semibold">{{ $info['travellers'] ?? '—' }}</p></div>
        <div><span class="text-xs font-bold uppercase tracking-wider text-slate-400">Travel Date</span><p class="font-semibold">{{ $info['travel_date'] ?: '—' }}</p></div>
        @if(!empty($info['message']))
          <div class="sm:col-span-2"><span class="text-xs font-bold uppercase tracking-wider text-slate-400">Message</span><p class="font-semibold">{{ $info['message'] }}</p></div>
        @endif
      </div>
    @endif
  </div>
@endif
