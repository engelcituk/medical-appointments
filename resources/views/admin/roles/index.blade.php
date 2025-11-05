{{-- texto plano, los props no llevan :, si llevan si es contenido php --}}
<x-admin-layout
    title="Roles"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Listado de roles',
        ]
    ]">

    <x-slot
        name="action"
    >
        <x-wire-button
            href="{{ route('admin.roles.create') }}"
            blue
        >
            <i class="fa-solid fa-plus"></i>
            Nuevo
        </x-wire-button>
    </x-slot>

    @livewire('admin.datatables.role-table')

</x-admin-layout>
