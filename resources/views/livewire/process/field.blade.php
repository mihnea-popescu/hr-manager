<div class="card">
    <div class="card-header">
        <h6 class="card-title">Câmpul #{{ number_format($order) }}</h6>
    </div>
    <div class="card-body row">
        <div class="col-md-5">
          <input type="text" class="form-control @error('title') is-invalid @enderror" placeholder="Titlu" wire:model.lazy="title" @if($process->status != \App\Models\Process::IN_WORK) disabled @endif>
          @error('title')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-md-5">
          <select class="form-control @error('type') is-invalid @enderror" wire:model="type" @if($process->status != \App\Models\Process::IN_WORK) disabled @endif>
            <option value="">Selectează tipul</option>
            @foreach ($types as $type)
              <option value="{{ $type }}">{{ __('labels.'.$type) }}</option>
            @endforeach
          </select>
          @error('type')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-md-2 text-center">
          @if ($process->status == \App\Models\Process::IN_WORK)
            <button type="button" class="btn btn-danger" wire:click="delete">
              <i class="ti ti-x"></i>
            </button>
          @endif
        </div>
      </div>
      
</div>
