{{-- texto plano, los props no llevan :, si llevan si es contenido php --}}
<x-admin-layout
    title="Doctores"
    :breadcrumbs="[
        [
            'name' => 'Dashboard',
            'href' => route('admin.dashboard')
        ],
        [
            'name' => 'Doctores',
            'href' => route('admin.doctors.index')
        ],
        [
            'name' => 'Editar'
        ]
    ]">

    <form
        action="{{route('admin.doctors.update', $doctor)}}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <x-wire-card class="mb-8">
            <div class="lg:flex lg:justify-between lg:items-center">

                <div class="flex items-center space-x-5">
                    <img
                        class="w-20 h-20 rounded-full object-cover object-center"
                        src="{{$doctor->user->profile_photo_url}}"
                        alt="{{ $doctor->user->name }}"
                    >
                    <div>
                        <p class="text-2xl font-bold text-gray-900">
                            {{$doctor->user->name }}
                        </p>
                        <p class="text-sm font-semibold text-gray-500">
                            Cédula profesional: {{ $doctor->user->medical_license_number ?? 'N/A' }}
                        </p>
                    </div>
                </div>

                <div class="flex space-x-3 mt-6 lg:mt-0">
                    <x-wire-button outline gray href="{{ route('admin.doctors.index') }}">
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
            <div class="space-y-4">
                <x-wire-native-select
                    label="Especialidad"
                    class="mb-4"
                    name="speciality_id"
                >
                    <option value="" selected>
                        Seleccione una especialidad
                    </option>
                    @foreach ($specialities as $speciality)
                        <option
                            value="{{$speciality->id}}"
                            @selected( $speciality->id == old('speciality_id', $doctor->speciality_id) )
                        >
                            {{$speciality->name}}
                        </option>
                    @endforeach
                </x-wire-native-select>

                <x-wire-input
                    label="Cedula profesional"
                    name="medical_license_number"
                    value="{{ old('medical_license_number', $doctor->medical_license_number) }}"
                ></x-wire-input>

                <x-wire-textarea
                    label="Biografia"
                    name="biography"
                    placeholder="Ingrese una breve biografia del doctor"
                >{{ old('biography', $doctor->biography) }}
                </x-wire-textarea>


            </div>
        </x-wire-card>

    </form>

</x-admin-layout>
