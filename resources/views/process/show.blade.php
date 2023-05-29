@extends('layouts.master')

@section('content')
<div class="card">
  <div class="card-header">
    <h5 class="card-title">Vezi procesul - {{ $process->name }}</h5>
    @if($process->status == \App\Models\Process::IN_WORK)
    <a href="{{ route('process.edit', ['process' => $process->id]) }}" class="btn btn-primary mt-2">Editează</a>
    @elseif($process->status == \App\Models\Process::ACCEPTING_APPLICATIONS)
    <form action="{{ route('process.update', ['process' => $process->id]) }}" method="POST">
      @csrf
      @method('PATCH')
      <input type="text" class="d-none" name="action" value="close_applications"/>
      <button class="btn btn-primary mt-2">Închide aplicațiile</button>
    </form>
    @endif
  </div>
  <div class="card-body">
    @if($process->status == \App\Models\Process::ACCEPTING_APPLICATIONS)
    <div class="row">
      <div class="col-12">
        <div class="alert alert-primary">
          Procesul acceptă aplicații la <code id="application-url">{{ route('application.create', ['hash' => $process->hash]) }}</code> <button id="copy-url"><i class="ti ti-copy"></i></button>
        </div>
      </div>
    </div>
    @endif
    <div class="row">
      <div class="col-md-6">
        <h6>Creator</h6>
        <p>{{ $process->user->name }}</p>
        <h6>Status</h6>
        <p>{{ $process->statusName }}</p>
        <h6>Departament</h6>
        <p>{{ $process->department->name }}</p>
        <h6>Număr de locuri</h6>
        <p>{{ $process->spots }}</p>
      </div>
      <div class="col-md-6">
        <h6>Nume</h6>
        <p>{{ $process->name }}</p>
        <h6>Descriere</h6>
        <p>{!! $process->description !!}</p>
      </div>
    </div>
  </div>
</div>

@if($process->status != \App\Models\Process::IN_WORK)

  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Aplicații finalizate - {{ number_format($process->applications()->where('status', \App\Models\Application::ACCEPTED)->count()) }}</h5>
    </div>
    <div class="card-body">
      <livewire:accepted-applications-data-table :process="$process"/>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Aplicații acceptate pentru interviu - {{ number_format($process->applications()->where('status', \App\Models\Application::ACCEPTED_FOR_INTERVIEW)->count()) }}</h5>
    </div>
    <div class="card-body">
      <livewire:interview-applications-data-table :process="$process"/>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Aplicații primite - {{ number_format($process->applications()->where('status', \App\Models\Application::PENDING)->count()) }}</h5>
    </div>
    <div class="card-body">
      <livewire:received-applications-data-table :process="$process"/>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Aplicații refuzate - {{ number_format($process->applications()->where('status', \App\Models\Application::REFUSED)->count()) }}</h5>
    </div>
    <div class="card-body">
      <livewire:refused-applications-data-table :process="$process"/>
    </div>
  </div>

@endif

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
      if(document.getElementById('copy-url')) {
        document.getElementById('copy-url').addEventListener('click', function () {
          navigator.clipboard.writeText(document.getElementById('application-url').innerHTML);
        })
      }
  });
</script>
@endpush