@extends('admin.layout')
@section('title','Edit '.$filename)
@section('content')
@if(session('success'))
<div class="mb-5 rounded-2xl bg-mist p-4 text-sm font-semibold text-forest">{{ session('success') }}</div>
@endif

<div class="mb-6 flex flex-wrap items-center justify-between gap-4">
  <div>
    <a href="{{ route('admin.json.index') }}" class="text-sm font-semibold text-forest">← All JSON files</a>
    <h1 class="mt-2 text-3xl">Edit {{ $filename }}</h1>
    <p class="mt-1 text-sm text-slate-500">{{ $description }}</p>
  </div>
  <a href="{{ route('admin.dashboard') }}" class="btn-outline">Back to dashboard</a>
</div>

<div class="card p-6">
  <form method="POST" action="{{ route('admin.json.update', $filename) }}">
    @csrf
    @method('PUT')
    <label class="text-sm font-semibold">JSON content</label>
    <textarea name="content" rows="28" class="mt-2 w-full rounded-2xl border-slate-200 font-mono text-sm leading-6" spellcheck="false" required>{{ $content }}</textarea>
    @error('content')
      <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
    <p class="mt-3 text-xs text-slate-400">Must be valid JSON. Invalid content will not be saved.</p>
    <div class="mt-5 flex flex-wrap gap-3">
      <button class="btn-primary">Save {{ $filename }}</button>
      <a href="{{ route('admin.json.index') }}" class="btn-outline">Cancel</a>
    </div>
  </form>
</div>
@endsection
