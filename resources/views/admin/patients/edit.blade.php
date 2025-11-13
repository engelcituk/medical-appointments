{{-- texto plano, los props no llevan :, si llevan si es contenido php --}}
<x-admin-layout
    title="Pacientes"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Pacientes',
            'href' => route('admin.patients.index')
        ],
        [
            'name' => 'Editar'
        ]
    ]">

    <form
        action="{{route('admin.patients.update', $patient->id)}}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-wire-card class="mb-8">
            <div class="lg:flex lg:justify-between lg:items-center">

                <div class="flex items-center space-x-5">
                    <img
                        class="w-20 h-20 rounded-full object-cover object-center"
                        src="{{$patient->user->profile_photo_url}}"
                        alt="{{ $patient->user->name }}"
                    >
                    <div>
                        <p class="text-2xl font-bold text-gray-900 mb-1">
                            {{$patient->user->name }}
                        </p>
                        <p class="text-sm font-bold text-gray-500">
                            Curp: {{$patient->user->curp ?? 'N/A'}}
                        </p>
                    </div>
                </div>

                <div class="flex space-x-3 mt-6 lg:mt-0">
                    <x-wire-button outline gray href="{{ route('admin.patients.index') }}">
                        Volver
                    </x-wire-button>

                    <x-wire-button type="submit">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Guardar cambios
                    </x-wire-button>

                </div>
            </div>
        </x-wire-card>

        <x-wire-card>

            <x-tabs active="personal-data">

                <x-slot name="header">
                    <x-tab-link tab="personal-data">
                        <i class="fa-solid fa-user me-2"></i>
                        Datos personales
                    </x-tab-link>

                    <x-tab-link tab="background">
                        <i class="fa-solid fa-file-lines me-2 "></i>
                        Antecedentes
                    </x-tab-link>

                    <x-tab-link tab="general-information">
                        <i class="fa-solid fa-info me-2 "></i>
                        Información general
                    </x-tab-link>

                    <x-tab-link tab="emergency-contact">
                        <i class="fa-solid fa-heart me-2 "></i>
                        Contacto de emergencia
                    </x-tab-link>
                </x-slot>

                <x-tab-content tab="personal-data">

                    <x-wire-alert title="Edición de usuario" info class="mb-4">
                        <div>
                            <p>
                                Para editar esta informacion, debe dirigirse
                                <a
                                    href="{{ route('admin.users.edit', $patient->user) }}"
                                    class="text-blue-600 hover:underline"
                                    target="_blank"
                                >
                                    al perfil asociado a este usuario
                                </a>
                            </p>
                        </div>
                        <div>

                        </div>
                    </x-wire-alert>

                    <div class="grid lg:grid-cols-2 gap-4">
                        <div>
                            <span
                                class="text-gray-500 font-semibold text-sm"
                            >
                                Teléfono:
                            </span>
                            <span class="text-gray-900 text-sm ml-1">
                                {{ $patient->user->phone }}
                            </span>
                        </div>
                        <div>
                            <span
                                class="text-gray-500 font-semibold text-sm"
                            >
                                Email:
                            </span>
                            <span class="text-gray-900 text-sm ml-1">
                                {{ $patient->user->email }}
                            </span>
                        </div>
                        <div>
                            <span
                                class="text-gray-500 font-semibold text-sm"
                            >
                                Dirección:
                            </span>
                            <span class="text-gray-900 text-sm ml-1">
                                {{ $patient->user->address }}
                            </span>
                        </div>
                    </div>
                </x-tab-content>

                <x-tab-content tab="background">
                    <div class="grid lg:grid-cols-2 gap-4">
                        <div>
                            <x-wire-textarea
                                label="Alergias conocidas"
                                name="allergies"
                            >
                            {{old('allergies', $patient->allergies)}}
                            </x-wire-textarea>
                        </div>
                        <div>
                            <x-wire-textarea
                                label="Enfermedades crónicas"
                                name="chronic_conditions"
                            >
                            {{old('chronic_conditions', $patient->chronic_conditions)}}
                            </x-wire-textarea>
                        </div>
                        <div>
                            <x-wire-textarea
                                label="Antecedentes quirúrgicos"
                                name="surgical_history"
                            >
                            {{old('surgical_history', $patient->surgical_history)}}
                            </x-wire-textarea>
                        </div>
                        <div>
                            <x-wire-textarea
                                label="Antecedentes familiares"
                                name="family_history"
                            >
                            {{old('allergies', $patient->family_history)}}
                            </x-wire-textarea>
                        </div>

                    </div>
                </x-tab-content>

                <x-tab-content tab="general-information">
                    <x-wire-native-select
                        label="Tipo de sangre"
                        class="mb-4"
                        name="blood_type_id"
                    >
                        <option value="" selected>
                            Seleccione un tipo de sangre
                        </option>
                        @foreach ($bloodTypes as $bloodType)
                            <option
                                value="{{$bloodType->id}}"
                                @selected( $bloodType->id == old('blood_type_id', $patient->blood_type_id) )
                            >
                                {{$bloodType->name}}
                            </option>
                        @endforeach
                    </x-wire-native-select>
                        <div>
                            <x-wire-textarea
                                label="Observaciones"
                                name="observations"
                            >
                            {{old('observations', $patient->observations)}}
                            </x-wire-textarea>
                        </div>
                </x-tab-content>

                <x-tab-content tab="emergency-contact">
                    <div class="space-y-4">
                        <x-wire-input
                            label="Nombre del contacto de emergencia"
                            name="emergency_contact_name"
                            value="{{old('emergency_contact_name', $patient->emergency_contact_name)}}"
                        />
                        <x-wire-input
                            label="Telefono del contacto"
                            name="emergency_contact_phone"
                            value="{{old('emergency_contact_phone', $patient->emergency_contact_phone)}}"
                        />
                        <x-wire-input
                            label="Relación con el contacto"
                            name="emergency_contact_relationship"
                            value="{{old('emergency_contact_relationship', $patient->emergency_contact_relationship)}}"
                        />
                    </div>
                </x-tab-content>

            </x-tabs>

        </x-wire-card>
    </form>

</x-admin-layout>
