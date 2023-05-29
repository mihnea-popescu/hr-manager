@php
    $process = \App\Models\Process::find($slot);
@endphp

<div class="d-inline-flex">
    <a href="{{ route('process.show', ['process' => $process->id]) }}" class="btn btn-sm btn-primary mx-2" title="Vezi procesul">
      <i class="ti ti-eye"></i>
    </a>

    <a href="{{ route('process.edit', ['process' => $process->id]) }}" class="btn btn-sm btn-primary" title="Editează procesul">
      <i class="ti ti-ballpen"></i>
    </a>
</div>
  