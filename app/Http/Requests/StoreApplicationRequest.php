<?php

namespace App\Http\Requests;

use App\Models\Process;
use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $basicRules = [
            'name' => ['required', 'min:4', 'max:255', 'string'],
            'phone' => ['required', 'min:10', 'max:10', 'string'],
            'email' => ['required', 'min:4', 'email', 'max:255', 'string']
        ];

        $processRules = $this->getProcessRules();

        $rules = array_merge($basicRules, $processRules);

        return $rules;
    }

    private function getProcessRules() {
        $hash = str_replace('apply/', "",$this->path());

        $process = Process::where('hash', $hash)->with('fields')->first();

        $rules = [];

        foreach($process->fields as $field) {
            if($field->type == \App\Models\ProcessField::TEXT || $field->type == \App\Models\ProcessField::LONGTEXT) {
                $rules['field_'.$field->id] = ['required', 'min:2', 'max:8000'];
            }

            if($field->type == \App\Models\ProcessField::NUMBER) {
                $rules['field_'.$field->id] = ['required', 'numeric', 'min:-999999', 'max:1000000'];
            }

            if($field->type == \App\Models\ProcessField::DATE) {
                $rules['field_'.$field->id] = ['required', 'date', 'date_format:Y-m-d'];
            }
        }

        return $rules;
    }
}
