<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\KategoriJamu;
use Illuminate\Support\Facades\Auth;

class KategoriCRUD extends Controller
{
    public function index()
    {
        $kategori = KategoriJamu::paginate(10);
        return view('admin.crud.kategorimanage', compact('kategori'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:64',
        ], [
            'nama_kategori.required'     => 'Nama kategori wajib diisi.',
            'nama_kategori.string'       => 'Nama kategori harus berupa teks.',
            'nama_kategori.max'          => 'Nama kategori maksimal 64 karakter.',
        ]);

        KategoriJamu::create($validated);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $KategoriJamu = KategoriJamu::findOrFail($id);

        $nama_lama = $KategoriJamu->nama_kategori;

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:64',
        ], [
            'nama_kategori.required'     => 'Nama kategori wajib diisi.',
            'nama_kategori.string'       => 'Nama kategori harus berupa teks.',
            'nama_kategori.max'          => 'Nama kategori maksimal 64 karakter.',
        ]);

        $nama_baru = $validated['nama_kategori'];

        $KategoriJamu->update($validated);

        return redirect()->back()->with('success', 'Kategori "' . $nama_lama . '" berhasil diperbarui menjadi "' . $nama_baru . '".');
    }

    public function destroy($id)
    {
        $jamu = KategoriJamu::findOrFail($id);
        $nama = $jamu->nama_kategori;
        $jamu->delete();
        return redirect()->back()->with('success', 'Kategori "' . $nama . '" berhasil dihapus.');
    }
}
