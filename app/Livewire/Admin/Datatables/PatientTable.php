<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Patient;

class PatientTable extends DataTableComponent
{
    // protected $model = Patient::class;

    public function builder(): Builder
    {
        return Patient::query()->with(['user',  'bloodType']);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "user.name")
                ->sortable(),
            Column::make("Curp", "user.curp")
                ->sortable(),
            Column::make("Email", "user.email")
                ->sortable(),
            Column::make("Teléfono", "user.phone"),
            Column::make("Fecha de creación", "created_at")
                ->sortable()
                ->format(function ($value) {
                    return $value->format('d/m/Y');
            }),
            Column::make("Acciones")
                ->label( function ($row) {
                    return view('admin.patients.actions', ['patient' => $row]);
            }),
        ];
    }
}
