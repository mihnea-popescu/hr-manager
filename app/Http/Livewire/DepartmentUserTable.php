<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ComponentColumn;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\DepartmentUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class DepartmentUserTable extends DataTableComponent
{
    public $department;

    protected $model = DepartmentUser::class;

    public function builder() : Builder {
        return $this->department->departmentUsers()->with('user')->getQuery();
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            ComponentColumn::make('Avatar', 'user.id')
                ->component('avatar')
                ->attributes(fn ($value, $row, Column $column) => [
                    'id' => $value,
                ]),
            Column::make('Nume', 'user.name')
                ->sortable()->searchable(),
            Column::make('E-mail', 'user.email')
                ->sortable()->searchable(),
            Column::make('Data nașterii', 'user.dob')
                ->sortable()->searchable(),
            BooleanColumn::make('Manager')
                ->sortable(),
            Column::make("S-a alăturat la", "created_at")
                ->sortable(),
        ];
    }
}
