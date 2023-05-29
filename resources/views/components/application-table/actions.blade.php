@php
    $application = \App\Models\Application::find($slot);
@endphp

<div class="d-inline-flex">
    <a href="{{ route('application.show', ['application' => $application->id]) }}" class="btn btn-sm btn-primary mx-2" title="Vezi aplicația" target="_blank">
      <i class="ti ti-eye"></i>
    </a>
</div>
  