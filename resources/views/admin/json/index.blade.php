@extends('admin.layout')
@section('title','JSON Data')
@section('content')
@if(session('success'))
<div class="mb-5 rounded-2xl bg-mist p-4 text-sm font-semibold text-forest">{{ session('success') }}</div>
@endif

<div class="mb-8">
  <h1 class="text-3xl">JSON data files</h1>
  <p class="mt-2 text-sm text-slate-500">Edit site content stored under <code class="rounded bg-white px-1.5 py-0.5">storage/app/data</code>.</p>
</div>

<div class="grid gap-5 md:grid-cols-3">
  @foreach($files as $file)
  <div class="card p-6">
    <p class="text-xs font-bold uppercase tracking-wider text-forest">{{ $file['filename'] }}</p>
    <h2 class="mt-2 text-xl">{{ str_replace('.json', '', $file['filename']) }}</h2>
    <p class="mt-2 text-sm text-slate-500">{{ $file['description'] }}</p>
    <p class="mt-4 text-xs text-slate-400">
      @if(is_array($file['preview']))
        {{ is_array($file['preview']) && array_is_list($file['preview']) ? count($file['preview']).' records' : count($file['preview']).' keys' }}
      @endif
    </p>
    <a href="{{ route('admin.json.edit', $file['filename']) }}" class="btn-primary mt-5">Edit JSON</a>
  </div>
  @endforeach
</div>
@endsection
