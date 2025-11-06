<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserTable extends DataTableComponent
{
    // protected $model = User::class;

    public function builder(): Builder
    {
        return User::query()->with('roles');
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
            Column::make("Nombre", "name")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Curp", "curp")
                ->sortable(),
            Column::make("Teléfono", "phone")
                ->sortable(),
            Column::make("Dirección", "address"),
            Column::make("Rol", "roles")->label(
                function ($row) {
                    return $row->roles->first()?->name ?? 'Sin rol';
                }
            ),
            Column::make("Fecha de creación", "created_at")
                ->sortable()
                ->format(function ($value) {
                    return $value->format('d/m/Y');
            }),
            Column::make("Acciones")
                ->label( function ($row) {
                    return view('admin.users.actions', ['user' => $row]);
            }),
        ];
    }
}
