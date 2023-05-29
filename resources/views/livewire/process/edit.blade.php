<div>
    @foreach($process->fields as $field)
        @livewire('process.field', [
            'field' => $field,
            'process' => $process,
            'order' => $process->fields->search(function($searchField) use ($field) {
                return $field->id == $searchField->id; 
            }) + 1
        ], key($field->id + rand(1000, 5000)))
    @endforeach

    @if($process->status == \App\Models\Process::IN_WORK)
        <div class="row mb-4">
            <div class="col-12">
                <button class="btn btn-primary" wire:click="addField" wire:loading.attr="disabled">
                    <i class="ti ti-plus"></i>
                </button>
            </div>
        </div>
    @endif

    @if($process->status == \App\Models\Process::IN_WORK && $process->fields->count())
        <hr/>

        <div class="row mt-4">
            <div class="col-12">
                <button class="btn btn-success" wire:click="publish" wire:loading.attr="disabled">
                    Publică
                </button>
            </div>
        </div>
    @endif

    @if($errorText)
        <div class="row mt-4">
            <div class="col-12">
                <span class="text-danger">{{ $errorText }}</span>
            </div>
        </div>
    @endif
</div>
