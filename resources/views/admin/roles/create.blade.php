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
            'name' => 'Nuevo'
        ]
    ]">

    <x-wire-card>
        <form action="{{ route('admin.roles.store') }}">
            @csrf
            <x-wire-input
                label="Nombre"
                name="name"
                placeholder="Ingrese el nombre del rol"
                value="{{ old('name') }}"
            />
            <div class="flex justify-end mt-4">
                <x-wire-button
                    type="submit"
                    blue
                >
                    <i class="fa-solid fa-floppy-disk"></i>
                    Guardar
                </x-wire-button>
            </div>
        </form>
    </x-wire-card>

</x-admin-layout>
