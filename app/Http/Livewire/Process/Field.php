<?php

namespace App\Http\Livewire\Process;

use App\Models\Process;
use App\Models\ProcessField;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Field extends Component
{
    public Process $process;
    public ProcessField $field;
    public $order;

    public $title;
    public $type;

    public $types = [];

    public function rules() {
        return [
            'title' => ['string', 'max:256', 'min:5'],
            'type' => ['string', 'max:256', Rule::in($this->types)],
        ];
    }

    // public function updated($propertyName)
    public function updatedTitle() {
        $this->validateOnly('title');

        if($this->process->status != \App\Models\Process::IN_WORK) {
            return;
        }

        $this->field->title = $this->title;
        $this->field->save();
    }

    public function updatedType() {
        $this->validateOnly('type');

        if($this->process->status != \App\Models\Process::IN_WORK) {
            return;
        }

        $this->field->type = $this->type;
        $this->field->save();
    }

    public function delete() {
        if($this->process->status != \App\Models\Process::IN_WORK) {
            return;
        }

        $this->field->delete();
        $this->emit('fieldDeleted');
    }

    public function mount() {
        $this->title = $this->field->title;
        $this->type = $this->field->type;

        $this->types = ProcessField::TYPES;
    }

    public function render()
    {
        return view('livewire.process.field');
    }
}
