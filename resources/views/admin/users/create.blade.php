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
            'name' => 'Nuevo'
        ]
    ]">

    <x-wire-card>
        <form
            action="{{ route('admin.users.store') }}"
            method="POST"
        >
            @csrf
            <div class="space-y-4">

                <div class="grid lg:grid-cols-2 gap-4">

                    <x-wire-input
                        label="Nombre"
                        name="name"
                        required
                        placeholder="Ingrese el nombre del usuario"
                        :value="old('name')"
                    />
                    <x-wire-input
                        label="Email"
                        name="email"
                        type="email"
                        required
                        placeholder="Ingrese el correo electrónico del usuario"
                        :value="old('email')"
                    />
                    <x-wire-input
                        label="Contraseña"
                        name="password"
                        type="password"
                        required
                        placeholder="Ingrese la contraseña del usuario"
                        :value="old('password')"
                    />
                    <x-wire-input
                        label="Confirmar Contraseña"
                        name="password_confirmation"
                        type="password"
                        required
                        placeholder="Confirme la contraseña del usuario"
                        :value="old('password')"
                    />

                    <x-wire-input
                        label="Curp"
                        name="curp"
                        required
                        placeholder="Ingrese la curp del usuario"
                        :value="old('curp')"
                        x-data="{}" {{-- Scope Alpine simple --}}
                        x-on:input="$event.target.value = $event.target.value.toUpperCase()" {{-- Convierte in-place --}}
                    />

                    <x-wire-input
                        label="Teléfono"
                        name="phone"
                        required
                        placeholder="Ingrese el teléfono del usuario"
                        :value="old('phone')"
                    />
                </div>


                <x-wire-input
                    label="Dirección"
                    name="address"
                    required
                    placeholder="Ingrese la dirección del usuario"
                    :value="old('address')"
                />

                <x-wire-native-select
                    label='Rol'
                    name="role_id"
                    required
                >
                    <option value=""> Seleccione un rol </option>
                    @foreach ($roles as $role)
                        <option
                            value="{{ $role->id }}"
                            @selected( old('role_id') == $role->id )
                        >
                            {{ $role->name }}
                        </option>
                    @endforeach
                </x-wire-native-select>

                <div class="flex justify-end" >
                    <x-wire-button
                        type="submit"
                    >
                        <i class="fa-solid fa-floppy-disk"></i>
                        Guardar
                    </x-wire-button>
                </div>

            </div>

        </form>
    </x-wire-card>

</x-admin-layout>
