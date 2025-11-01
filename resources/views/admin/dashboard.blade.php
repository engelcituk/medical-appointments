{{-- texto plano, los props no llevan :, si llevan si es contenido php --}}
<x-admin-layout
    title="Dashboard"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Prueba',
        ]
    ]">
    <x-slot name="action">
        <x-button>
            Prueba
        </x-button>
    </x-slot>

</x-admin-layout>
