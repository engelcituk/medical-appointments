<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'curp' => 'nullable|string|min:18|max:18|unique:users',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $user = User::create($data);

        $user->roles()->attach($data['role_id']);

        session()->flash('swal', [
            'title' => 'Usuario creado',
            'text' =>  'Usuario '.$user->name.' fue creado correctamente.',
            'icon' => 'success',
        ]);

        if($user->hasRole('Patient')){
            $patient = $user->patient()->create([]);
            return redirect()->route('admin.patients.edit', $patient);
        }

        if($user->hasRole('Doctor')){
            $doctor = $user->doctor()->create([]);
            return redirect()->route('admin.doctors.edit', $doctor);
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.users.edit', compact('user', 'roles') );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'curp' => 'nullable|string|min:18|max:18|unique:users,curp,'.$user->id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        $user->update($data);

        if ($request->password) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        $user->roles()->sync($data['role_id']);

        session()->flash('swal', [
            'title' => 'Usuario actualizado',
            'text' =>  'El usuario '.$user->name.' fue actualizado correctamente.',
            'icon' => 'success',
        ]);

        return redirect()->route('admin.users.edit', $user);
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(User $user)
    {
        $user->roles()->detach();

        $user->delete();

        session()->flash('swal', [
            'title' => 'Usuario eliminado',
            'text' =>  'Usuario '.$user->name.' fue eliminado correctamente.',
            'icon' => 'success',
        ]);
        return redirect()->route('admin.users.index');
    }
}
