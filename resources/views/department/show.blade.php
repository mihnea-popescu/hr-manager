@extends('layouts.master')

@section('content')

@if($department->type == \App\Models\Department::RECRUITMENT)
<div class="card">
    <div class="card-body">
      <a href="{{ route('department.processes', ['department' => $department->id]) }}" class="btn btn-primary">
        Procese
      </a>
    </div>
</div>
@endif

<div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Angajați</h5>
      <livewire:department-user-table :department="$department"/>
    </div>
</div>
@endsection