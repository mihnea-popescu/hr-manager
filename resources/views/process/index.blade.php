@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Procese</h5>
      <livewire:department-processes-data-table :department="0"/>
    </div>
</div>

@endsection