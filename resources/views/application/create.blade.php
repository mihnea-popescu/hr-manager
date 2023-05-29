@extends('layouts.application')

@section('content')
{!! $process->description !!}
<hr/>
<form action="{{ route('application.store', ['hash' => $process->hash]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nume</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" maxlength="255" value="{{ old('name') }}" placeholder="Robert Popescu">
        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group mt-4">
        <label for="phone">Număr de telefon</label>
        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" maxlength="255" value="{{ old('phone') }}" placeholder="0712312456">
        @error('phone')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group mt-4">
        <label for="email">Adresă e-mail</label>
        <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" maxlength="255" value="{{ old('email') }}" placeholder="ion_popescu@gmail.com">
        @error('email')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    @foreach($process->fields as $field)
    <div class="form-group mt-4">
        <label for="field_{{ $field->id }}">{{ $field->title }}</label>
        @if($field->type == \App\Models\ProcessField::TEXT)
            <input type="text" id="field_{{ $field->id }}" name="field_{{ $field->id }}" value="{{ old('field_'.$field->id) }}" class="form-control @error('field_'.$field->id) is-invalid @enderror">
        @elseif($field->type == \App\Models\ProcessField::LONGTEXT)
            <textarea id="field_{{ $field->id }}" name="field_{{ $field->id }}" class="form-control @error('field_'.$field->id) is-invalid @enderror">{{ old('field_'.$field->id) }}</textarea>
        @elseif($field->type == \App\Models\ProcessField::NUMBER)
            <input type="number" step="0.01" id="field_{{ $field->id }}" name="field_{{ $field->id }}" value="{{ old('field_'.$field->id) }}" class="form-control @error('field_'.$field->id) is-invalid @enderror">
        @elseif($field->type == \App\Models\ProcessField::DATE)
            <input type="date" id="field_{{ $field->id }}" name="field_{{ $field->id }}" value="{{ old('field_'.$field->id) }}" class="form-control @error('field_'.$field->id) is-invalid @enderror">
        @endif
        @error('field_'.$field->id)
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
    @endforeach

    <button type="submit" class="btn btn-primary mt-4">Trimite</button>
</form>
@endsection