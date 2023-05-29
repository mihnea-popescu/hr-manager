@extends('layouts.master')

@section('content')
<div class="card">
    <div class="card-body">
      <h5 class="card-title">Editează Utilizatorul</h5>
      <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="form-group mb-4">
          <label for="name">Nume</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
          @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
  
        <div class="form-group mb-4">
          <label for="email">Email</label>
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
          @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
  
        <div class="form-group mb-4">
          <label for="dob">Data nașterii</label>
          <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob', Carbon\Carbon::parse($user->dob)->format('Y-m-d')) }}" required>
          @error('dob')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
  
        <button type="submit" class="btn btn-primary">Editează</button>
      </form>
    </div>
  </div>
  
@endsection