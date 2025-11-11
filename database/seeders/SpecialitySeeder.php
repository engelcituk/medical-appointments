<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Speciality;

class SpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialities = [
            'Cardiología',
            'Pediatría',
            'Ginecología',
            'Gastroenterología',
            'Neurología',
            'Oncología',
            'Urología',
            'Medicina Interna', // Troncal y esencial
            'Dermatología',
            'Oftalmología',
            'Otorrinolaringología',
            'Neumología',
            'Nefrología',
            'Endocrinología',
            'Hematología',
            'Reumatología',
            'Psiquiatría',
            'Traumatología y Ortopedia', // Especialidad Quirúrgica
            'Cirugía General', // Especialidad Quirúrgica
            'Anestesiología y Reanimación',
            'Radiología o Radiodiagnóstico', // Especialidad de Diagnóstico
            'Medicina Familiar y Comunitaria',
            'Geriatría',
            'Infectología',
        ];

        foreach ($specialities as $speciality) {
            Speciality::create([
                'name' => $speciality,
            ]);
        }
    }
}
