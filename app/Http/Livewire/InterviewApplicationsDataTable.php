<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Application;
use App\Models\Process;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;

class InterviewApplicationsDataTable extends DataTableComponent
{
    protected $model = Application::class;

    public Process $process;

    public function builder () : Builder {
        return $this->process->applications()->where('status', Application::ACCEPTED_FOR_INTERVIEW)->getQuery();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Nume", "name")
                ->sortable()->searchable(),
            Column::make("Email", "email")
                ->sortable()->searchable(),
            Column::make("Telefon", "phone")
                ->sortable()->searchable(),
            Column::make("Înregistrat la", "created_at")
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => Carbon::parse($row->created_at)->format('d-m-Y H:m')
                ),
            ComponentColumn::make('Acțiuni', 'id')
                ->component('application-table.actions')
                ->attributes(fn ($value, $row, Column $column) => [
                    'id' => $value,
                ]),
        ];
    }
}
