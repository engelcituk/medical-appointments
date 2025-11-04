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
            'href' => route('admin.roles.index')
        ],
        [
            'name' => 'Editar'
        ]
    ]">

</x-admin-layout>
