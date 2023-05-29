@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Procese</h5>
      <a href="{{ route('process.create', ['department' => $department->id]) }}" class="btn btn-primary mb-4">
        <i class="ti ti-plus"></i>
        Creează proces
      </a>
      <livewire:department-processes-data-table :department="$department"/>
    </div>
</div>

@endsection