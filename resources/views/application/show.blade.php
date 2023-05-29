@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Aplicație #{{ number_format($application->id) }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
              <h6>Trimisă la</h6>
              <p>{{ Carbon\Carbon::parse($application->created_at)->format('d-m-Y H:i') }}</p>
              <h6>Status</h6>
              <p>{{ __('labels.'.$application->status) }}</p>
              <h6>Nume</h6>
              <p>{{ $application->name }}</p>
              <h6>Email</h6>
              <p><a href="mailto:{{ $application->email }}">{{ $application->email }}</a></p>
              <h6>Număr de telefon</h6>
              <p><a href="tel:{{ $application->phone }}">{{ $application->phone }}</a></p>
              <hr/>
              @foreach($processFields as $processField)
                <h6>{{ $processField->title }}</h6>
                <p>{{ $fields->where('field_id', $processField->id)->first()->value }}</p>
              @endforeach
            </div>
          </div>
    </div>
    <div class="card-footer">
        @if($application->status == \App\Models\Application::PENDING && $process->status != \App\Models\Process::FINISHED)
            <div class="row">
                <div class="col-6 text-center">
                    <form action="{{ route('application.update', ['application' => $application->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input class="d-none" name="action" value="accept">
                        <button type="submit" class="btn btn-success">Acceptă</button>
                    </form>
                </div>
                <div class="col-6 text-center">
                    <form action="{{ route('application.update', ['application' => $application->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input class="d-none" name="action" value="refuse">
                        <button type="submit" class="btn btn-danger">Refuză</button>
                    </form>
                </div>
            </div>
        @elseif($application->status == \App\Models\Application::ACCEPTED_FOR_INTERVIEW && $process->status != \App\Models\Process::FINISHED)
            <div class="row">
                <div class="col-6 text-center">
                    <form action="{{ route('application.update', ['application' => $application->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input class="d-none" name="action" value="complete">
                        <button type="submit" class="btn btn-success">Acceptă</button>
                    </form>
                </div>
                <div class="col-6 text-center">
                    <form action="{{ route('application.update', ['application' => $application->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <input class="d-none" name="action" value="refuse">
                        <button type="submit" class="btn btn-danger">Refuză</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection