@extends('layouts.master')

@section('content')

<div class="row">
    @foreach($departments as $department)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $department->name }}</h5>
                    <p class="card-text">{{ $department->users()->count() }} membri</p>
                    <a href="{{ route('department.show', ['department' => $department->id]) }}" class="btn btn-primary">Vezi detalii</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection