<?php

namespace App\Http\Controllers\CRUD;

use App\Models\Jamu;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProdukCRUD extends Controller
{
    public function index()
    {
        $jamu = Jamu::paginate(10);
        $kategoriList = DB::table('kategori')->get();
        return view('admin.crud.produkmanage', compact('jamu', 'kategoriList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jamu'         => 'required|string|max:64',
            'harga'             => 'required|numeric|min:0',
            'stok'              => 'required|integer|min:0',
            'id_kategori'       => 'required|array',
            'id_kategori.*'     => 'exists:kategori,id_kategori',
            'komposisi'         => 'required|string',
            'deskripsi'         => 'required|string',
            'aturan_pakai'      => 'required|string',
            'berat'             => 'required|integer|min:0',
            'manfaat'           => 'required|string',
            'gambar'            => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama_jamu.required'     => 'Nama jamu wajib diisi.',
            'nama_jamu.string'       => 'Nama jamu harus berupa teks.',
            'nama_jamu.max'          => 'Nama jamu maksimal 64 karakter.',

            'harga.required'         => 'Harga wajib diisi.',
            'harga.numeric'          => 'Harga harus berupa angka.',

            'stok.required'          => 'Stok wajib diisi.',
            'stok.integer'           => 'Stok harus berupa bilangan bulat.',

            'berat.required'         => 'Berat wajib diisi.',
            'berat.integer'          => 'Berat harus berupa angka.',

            'komposisi.required'     => 'Komposisi wajib diisi.',
            'komposisi.string'       => 'Komposisi harus berupa teks.',

            'deskripsi.required'     => 'Deskripsi wajib diisi.',
            'deskripsi.string'       => 'Deskripsi harus berupa teks.',

            'aturan_pakai.required'  => 'Aturan pakai wajib diisi.',
            'aturan_pakai.string'    => 'Aturan pakai harus berupa teks.',

            'manfaat.required'       => 'Manfaat wajib diisi.',
            'manfaat.string'         => 'Manfaat harus berupa teks.',

            'id_kategori.required'   => 'Kategori wajib dipilih.',
            'id_kategori.array'      => 'Kategori tidak valid.',
            'id_kategori.*.exists'   => 'Kategori yang dipilih tidak ditemukan.',

            'gambar.required'        => 'Gambar wajib diunggah.',
            'gambar.image'           => 'File harus berupa gambar.',
            'gambar.mimes'           => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg.',
            'gambar.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Upload gambar
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            $path = public_path('assets/images/products');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            $image->move($path, $imageName);
            $validated['gambar'] = $imageName;
        }

        // Buat fitur_index otomatis
        $fitur = strtolower($validated['manfaat'] . ' ' . $validated['deskripsi'] . ' ' . $validated['komposisi']);
        $tokens = implode(',', preg_split('/\s+/', trim($fitur)));
        $validated['fitur_index'] = $tokens;

        // Simpan ke database (langsung include id_kategori array)
        $validated['id_kategori'] = array_values($validated['id_kategori']); // pastikan numerik key

        Jamu::create($validated);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan.');
    }



    public function update(Request $request, $id)
    {
        $jamu = Jamu::findOrFail($id);

        $validated = $request->validate([
            'nama_jamu'         => 'required|string|max:64',
            'harga'             => 'required|numeric|min:0',
            'stok'              => 'required|integer|min:0',
            'id_kategori'       => 'required|array',
            'id_kategori.*'     => 'exists:kategori,id_kategori',
            'komposisi'         => 'required|string',
            'deskripsi'         => 'required|string',
            'aturan_pakai'      => 'required|string',
            'berat'             => 'required|integer|min:0',
            'manfaat'           => 'required|string',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama_jamu.required'     => 'Nama jamu wajib diisi.',
            'nama_jamu.string'       => 'Nama jamu harus berupa teks.',
            'nama_jamu.max'          => 'Nama jamu maksimal 64 karakter.',

            'harga.required'         => 'Harga wajib diisi.',
            'harga.numeric'          => 'Harga harus berupa angka.',

            'stok.required'          => 'Stok wajib diisi.',
            'stok.integer'           => 'Stok harus berupa bilangan bulat.',

            'berat.required'         => 'Berat wajib diisi.',
            'berat.integer'          => 'Berat harus berupa angka.',

            'komposisi.required'     => 'Komposisi wajib diisi.',
            'komposisi.string'       => 'Komposisi harus berupa teks.',

            'deskripsi.required'     => 'Deskripsi wajib diisi.',
            'deskripsi.string'       => 'Deskripsi harus berupa teks.',

            'aturan_pakai.required'  => 'Aturan pakai wajib diisi.',
            'aturan_pakai.string'    => 'Aturan pakai harus berupa teks.',

            'manfaat.required'       => 'Manfaat wajib diisi.',
            'manfaat.string'         => 'Manfaat harus berupa teks.',

            'id_kategori.required'   => 'Kategori wajib dipilih.',
            'id_kategori.array'      => 'Kategori tidak valid.',
            'id_kategori.*.exists'   => 'Kategori yang dipilih tidak ditemukan.',

            'gambar.image'           => 'File harus berupa gambar.',
            'gambar.mimes'           => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg.',
            'gambar.max'             => 'Ukuran gambar maksimal 2MB.',
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Buat direktori jika belum ada
            $path = public_path('assets/images/products');
            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Pindahkan file ke direktori yang diinginkan
            $image->move($path, $imageName);

            // Simpan nama file ke database
            $validated['gambar'] = $imageName;
        } else {
            unset($validated['gambar']);
        }

        $validated['id_kategori'] = $validated['id_kategori'] ?? [];

        // Fitur index bisa diisi secara otomatis:
        $fitur = strtolower($validated['manfaat'] . ' ' . $validated['deskripsi'] . ' ' . $validated['komposisi']);
        $tokens = implode(',', preg_split('/\s+/', trim($fitur)));
        $validated['fitur_index'] = $tokens;

        $jamu->update($validated);

        return redirect()->back()->with('success', 'Produk berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $jamu = Jamu::findOrFail($id);
        $nama = $jamu->nama_jamu;
        $jamu->delete();
        return redirect()->back()->with('success', 'Produk "' . $nama . '" berhasil dihapus.');
    }
}
