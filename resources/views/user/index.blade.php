@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Angajați</h5>
      <livewire:user-datatable/>
    </div>
</div>
@endsection