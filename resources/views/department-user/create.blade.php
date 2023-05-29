@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">
      <h5 class="card-title">Adaugă un utilizator într-un departament</h5>
      <form action="{{ route('department-user.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf
        
        <div class="form-group mb-3">
          <label for="user">Utilizator</label>
          <select name="user" id="user" class="form-control select2" required>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(request()->get('user_id') == $user->id || old('user') == $user->id)>{{ $user->name }}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">Selectează un utilizator.</div>
        </div>
  
        <div class="form-group mb-3">
          <label for="department">Department</label>
          <select name="department" id="department" class="form-control select2" required>
            @foreach ($departments as $department)
            <option value="{{ $department->id }}" @selected(old('department') == $department->id)>{{ $department->name }}</option>
            @endforeach
          </select>
          <div class="invalid-feedback">Selectează un departament.</div>
        </div>
  
        <button type="submit" class="btn btn-primary">Adaugă</button>
      </form>
    </div>
</div>
  
@endsection

@push('scripts')
<script>
    jQuery(document).ready(function() {
      jQuery('.select2').select2();
    });
  </script>
@endpush