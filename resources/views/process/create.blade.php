@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Creează proces</h5>
      <form action="{{ route('process.store', ['department' => $department->id]) }}" method="POST" class="needs-validation" novalidate>
        @csrf
      
        <div class="form-group mb-3">
          <label for="name">Nume</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" maxlength="255" required>
          @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      
        <div class="form-group mb-3">
          <label for="description">Descriere</label>
          <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" maxlength="32000" required>{{ old('description') }}</textarea>
          @error('description')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      
        <div class="form-group mb-3">
          <label for="spots">Număr de locuri</label>
          <input type="number" class="form-control @error('spots') is-invalid @enderror" id="spots" name="spots" value="{{ old('spots') }}" required>
          @error('spots')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      
        <button type="submit" class="btn btn-primary">Trimite</button>
      </form>      
    </div>
</div>

@endsection


@push('scripts')
<script>
    tinymce.init({
      selector: '#description',
      height: 400,
      plugins: 'advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen',
      toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | link image',
      promotion: false,
      branding: false,
      image_title: true,
      image_caption: true,
      automatic_uploads: true,
      file_picker_types: 'image',
      file_picker_callback: function(callback, value, meta) {
        // Add your file picker logic here
      }
    });
</script>
@endpush