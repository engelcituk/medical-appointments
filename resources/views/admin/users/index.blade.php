{{-- texto plano, los props no llevan :, si llevan si es contenido php --}}
<x-admin-layout
    title="Usuarios"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Usuarios',
        ]
    ]">

    <x-slot
        name="action"
    >
        <x-wire-button
            href="{{ route('admin.users.create') }}"
            blue
        >
            <i class="fa-solid fa-plus"></i>
            Nuevo
        </x-wire-button>
    </x-slot>

</x-admin-layout>
