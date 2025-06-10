<?php

namespace App\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AkunUserCRUD extends Controller
{
    /**
     * Menampilkan daftar semua pengguna biasa (role 0).
     */
    public function index()
    {
        // Ambil data pengguna dengan role 0 (pengguna biasa)
        $users = User::where('role', 0)
                     ->orderBy('name', 'asc')
                     ->paginate(15);

        // Kirim data ke view baru
        return view('admin.crud.akunusermanage', compact('users'));
    }

    /**
     * Menghapus akun pengguna biasa.
     */
    public function destroy($id)
    {
        // Ambil data pengguna yang akan menghapus dan yang akan dihapus
        $deletingUser = Auth::user();
        $userToDelete = User::findOrFail($id);

        // Syarat 1: Hanya Admin (1) atau Manager (2) yang bisa menghapus
        if (!in_array($deletingUser->role, [1, 2])) {
            return redirect()->route('panel.akunuser')->with('error', 'Anda tidak memiliki hak untuk menghapus akun.');
        }

        // Syarat 2: Hanya akun pengguna biasa (0) yang boleh dihapus di sini
        if ($userToDelete->role != 0) {
            return redirect()->route('panel.akunuser')->with('error', 'Aksi tidak diizinkan untuk role ini.');
        }

        // Jika semua syarat terpenuhi, hapus pengguna
        $userToDelete->delete();

        return redirect()->route('panel.akunuser')->with('success', 'Akun pengguna berhasil dihapus.');
    }
}
