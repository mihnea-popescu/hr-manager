<?php

namespace App\Http\Livewire;

use App\Models\Department;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Process;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;

class DepartmentProcessesDataTable extends DataTableComponent
{
    protected $model = Process::class;

    public $department;

    public function builder() : Builder {
        return $this->department ? $this->department->processes()->with('user')->getQuery() : Process::query();
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
            Column::make("Status", "status")
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => Process::getStatus($row->status)
                ),
            Column::make("Număr de locuri", "spots")
                ->sortable()->searchable(),
            Column::make("Aplicații", "id")
                ->format(
                    fn($value, $row, Column $column) => Process::find($row->id)->applications()->count()
                ),
            Column::make("Autor", "user.name")
                ->sortable()->searchable(),
            Column::make("Creat la", "created_at")
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => Carbon::parse($row->created_at)->format('d-m-Y H:m')
                ),
            ComponentColumn::make('Acțiuni', 'id')
                ->component('process-table.actions')
                ->attributes(fn ($value, $row, Column $column) => [
                    'id' => $value,
                ]),
        ];
    }
}
