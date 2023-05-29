@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-header">
      <h5 class="card-title">Editează procesul - {{ $process->name }}</h5>
    </div>
    <div class="card-body">
      @livewire('process.edit', compact("process"))
    </div>
  </div>
  
@endsection