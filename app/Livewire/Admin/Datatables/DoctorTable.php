<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Doctor;

class DoctorTable extends DataTableComponent
{
    // protected $model = Doctor::class;
    public function builder(): Builder
    {
        return Doctor::query()->with(['user',  'speciality']);
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
            Column::make("Email", "user.email")
                ->sortable(),
            Column::make("Especialidad", "speciality.name")
                ->format(function ($value) {
                    return $value ?: 'N/A';
                })
                ->sortable(),
            Column::make("Cédula profesional", "medical_license_number")
                ->format(function ($value) {
                    return $value ?: 'N/A';
                })
                ->sortable(),
            Column::make("Fecha de creación", "created_at")
                ->sortable()
                ->format(function ($value) {
                    return $value->format('d/m/Y');
            }),
            Column::make("Acciones")
                ->label( function ($row) {
                    return view('admin.doctors.actions', ['doctor' => $row]);
            }),
        ];
    }
}
