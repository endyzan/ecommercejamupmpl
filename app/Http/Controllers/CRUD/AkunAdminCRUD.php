<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class AkunAdminCRUD extends Controller
{
    /**
     * Menampilkan daftar akun dengan role admin dan manager.
     */
    public function index()
    {
        $loggedInUserId = Auth::id();
        $users = User::whereIn('role', [1, 2])
                     ->where('id', '!=', $loggedInUserId)
                     ->orderBy('name', 'asc')
                     ->paginate(10);

        return view('admin.crud.akunadminmanage', compact('users'));
    }

    /**
     * Menampilkan form untuk membuat akun baru.
     * Hanya Manager (role 2) yang bisa mengakses.
     */
    public function create()
    {
        if (Auth::user()->role != 2) {
            return redirect()->route('panel.akunadmin')->with('error', 'Hanya Manager yang dapat menambah akun baru.');
        }
        return view('admin.crud.akunadmincreate');
    }

    /**
     * Menyimpan akun baru ke database.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role != 2) {
            return redirect()->route('panel.akunadmin')->with('error', 'Anda tidak memiliki hak akses.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', Rule::in([1, 2])], // Hanya bisa membuat role admin (1) atau manager (2)
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('panel.akunadmin')->with('success', 'Akun baru berhasil dibuat.');
    }


    /**
     * Menampilkan form untuk mengedit akun.
     */
    public function edit($id)
    {
        $userToEdit = User::findOrFail($id);
        $editingUser = Auth::user();

        // Manager (2) bisa mengedit Admin (1)
        if ($editingUser->role == 2 && $userToEdit->role == 1) {
             return view('admin.crud.akunadminedit', compact('userToEdit'));
        }
        
        // Tolak jika Admin mencoba mengedit atau Manager mencoba mengedit Manager lain
        return redirect()->route('panel.akunadmin')->with('error', 'Anda tidak memiliki hak untuk mengedit akun ini.');
    }

    /**
     * Memperbarui data akun di database.
     */
    public function update(Request $request, $id)
    {
        $userToUpdate = User::findOrFail($id);
        $editingUser = Auth::user();
        
        // Otorisasi: Hanya Manager yang bisa mengedit Admin
        if (!($editingUser->role == 2 && $userToUpdate->role == 1)) {
            return redirect()->route('panel.akunadmin')->with('error', 'Anda tidak memiliki hak untuk memperbarui akun ini.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($userToUpdate->id)],
            'role' => ['required', Rule::in([1])], // Hanya bisa diubah menjadi admin
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $userToUpdate->name = $request->name;
        $userToUpdate->username = $request->username;
        $userToUpdate->email = $request->email;
        $userToUpdate->role = $request->role;

        // Hanya perbarui password jika diisi
        if ($request->filled('password')) {
            $userToUpdate->password = Hash::make($request->password);
        }

        $userToUpdate->save();

        return redirect()->route('panel.akunadmin')->with('success', 'Akun berhasil diperbarui.');
    }

    /**
     * Menghapus data akun dari database dengan logika otorisasi.
     */
    public function destroy($id)
    {
        $deletingUser = Auth::user();
        $userToDelete = User::findOrFail($id);

        if ($deletingUser->id == $userToDelete->id) {
            return redirect()->route('panel.akunadmin')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        if ($deletingUser->role == 2) {
            if ($userToDelete->role == 1 || $userToDelete->role == 0) {
                $userToDelete->delete();
                return redirect()->route('panel.akunadmin')->with('success', 'Akun berhasil dihapus.');
            }
        }

        if ($deletingUser->role == 1) {
            if ($userToDelete->role == 0) {
                $userToDelete->delete();
                return redirect()->route('panel.akunadmin')->with('success', 'Akun berhasil dihapus.');
            }
        }

        return redirect()->route('panel.akunadmin')->with('error', 'Anda tidak memiliki hak untuk menghapus akun ini.');
    }
}
