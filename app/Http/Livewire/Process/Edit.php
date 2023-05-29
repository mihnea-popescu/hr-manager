<?php

namespace App\Http\Livewire\Process;

use App\Models\Process;
use App\Models\ProcessField;
use Livewire\Component;

class Edit extends Component
{
    public Process $process;

    public $errorText;

    protected $listeners = [
        'fieldDeleted' => 'reloadFields'
    ];

    public function reloadFields() {
        $this->process->load('fields');
    }

    public function publish() {
        if($this->process->status != Process::IN_WORK) {
            return;
        }

        // Validate
        $this->reset('errorText');

        $count = 0;
        foreach($this->process->fields as $field) {
            $count++;
            if(!$field->title || !$field->type) {
                $this->errorText = 'Câmpul #'.number_format($count).' nu este complet.';
                return false;
            }
        }

        $this->process->status = \App\Models\Process::ACCEPTING_APPLICATIONS;
        $this->process->save();

        return redirect()->route('process.show', ['process' => $this->process->id])->with('success', 'Procesul a fost publicat.');
    }

    public function addField() {
        if($this->process->status != Process::IN_WORK) {
            return;
        }

        $this->process->fields()->save(new ProcessField);

        $this->reloadFields();
    }

    public function render()
    {
        $this->reloadFields();

        return view('livewire.process.edit');
    }
}
