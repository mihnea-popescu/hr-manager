<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;

class UserDatatable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            ComponentColumn::make('Avatar', 'id')
            ->component('avatar')
            ->attributes(fn ($value, $row, Column $column) => [
                'id' => $value,
            ]),
            Column::make("Nume", "name")
                ->sortable()->searchable(),
            ComponentColumn::make('Departamente', 'id')
                ->component('department')
                ->attributes(fn ($value, $row, Column $column) => [
                    'id' => $value,
                ]),
            Column::make("Data nașterii", 'dob')
                ->sortable()->searchable(),
            Column::make("Email", "email")
                ->sortable()->searchable(),
            Column::make("Înregistrat la", "created_at")
                ->sortable()
                ->format(
                    fn($value, $row, Column $column) => Carbon::parse($row->created_at)->format('d-m-Y H:m')
                ),
            ComponentColumn::make('Departamente', 'id')
                ->component('department')
                ->attributes(fn ($value, $row, Column $column) => [
                    'id' => $value,
                ]),
            ComponentColumn::make('Acțiuni', 'id')
                ->component('user-table.actions')
                ->attributes(fn ($value, $row, Column $column) => [
                    'id' => $value,
                ]),
        ];
    }
}
