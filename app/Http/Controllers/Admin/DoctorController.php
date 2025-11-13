<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Speciality;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.doctors.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $specialities = Speciality::all();
        return view('admin.doctors.edit', compact('doctor', 'specialities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {

        $data = $request->validate([
            'speciality_id' => 'nullable|exists:specialities,id',
            'medical_license_number' => 'nullable|string|max:255|unique:doctors,medical_license_number,'.$doctor->id,
            'biography' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $doctor->update($data);

        session()->flash('swal', [
            'title' => 'Doctor actualizado',
            'text' =>  'Doctor '.$doctor->user->name.' fue actualizado correctamente.',
            'icon' => 'success',
        ]);

        return redirect()->route('admin.doctors.edit', $doctor);
    }

    public function schedules(Doctor $doctor)
    {
        return view('admin.doctors.schedules', compact('doctor'));
    }

}
