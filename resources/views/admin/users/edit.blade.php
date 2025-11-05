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
            'href' => route('admin.users.index')
        ],
        [
            'name' => 'Editar'
        ]
    ]">

</x-admin-layout>
