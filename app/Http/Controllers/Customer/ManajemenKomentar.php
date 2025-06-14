<?php

namespace App\Http\Controllers\Customer;

use App\Models\Alamat;
use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\DetilTransaksi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Jamu;
use Illuminate\Support\Facades\Auth;

class ManajemenKomentar extends Controller
{
    public function showRatingForm($id)
    {
        $jamu = Jamu::findOrFail($id);
        return view('customer.rating', compact('jamu'));
    }

    public function storeRating(Request $request)
    {
        $request->validate([
            'id_jamu' => 'required|exists:jamu,id_jamu',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:255',
        ], [
            'id_jamu.required' => 'ID jamu harus diisi.',
            'id_jamu.exists' => 'Jamu tidak ditemukan.',
            'rating.required' => 'Rating harus diisi.',
            'rating.integer' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal 1.',
            'rating.max' => 'Rating maksimal 5.',
            'komentar.string' => 'Komentar harus berupa teks.',
            'komentar.max' => 'Komentar tidak boleh lebih dari 255 karakter.',
        ]);

        $userId = Auth::id();

        DB::table('komentar')->insert([
            'id_jamu' => $request->id_jamu,
            'id_user' => $userId,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('product.productDetail', $request->id_jamu)->with('success', 'Rating dan komentar berhasil disimpan.');
    }
}
