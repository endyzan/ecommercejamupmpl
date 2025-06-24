<?php

namespace App\Http\Controllers\Customer;

use App\Models\Keranjang;
use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\DetilTransaksi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManajemenKeranjang extends Controller
{
    public function showCart(): View
    {
        $userId = Auth::id();
        $user = Auth::user(); // Diperbaiki: Ambil user untuk alamat
        $alamatUser = $user->alamatList ?? [];

        // Ambil keranjang milik user saat ini beserta data jamunya
        $cartItems = Keranjang::with('jamu')
            ->where('id_user', $userId)
            ->get()
            ->groupBy('id_jamu');

        $carts = [];

        foreach ($cartItems as $items) {
            $first = $items->first();
            // Jika produk tidak ditemukan (relasi jamu null), hapus semua item dari keranjang
            if (!$first->jamu) {
                foreach ($items as $item) {
                    $item->delete(); // Hapus item yang tidak memiliki produk
                }
                continue; // Lewati proses selanjutnya
            }
            $quantity = $items->count();
            $price = $first->jamu->harga ?? 0; // Pastikan harga tersedia
            $subtotal = $price * $quantity;

            $carts[] = (object)[
                'id_jamu' => $first->jamu->id_jamu ?? 0,
                'name' => $first->jamu->nama_jamu ?? 'Produk tidak ditemukan',
                'price' => $price,
                'quantity' => $quantity,
                'subtotal' => $subtotal
            ];
        }

        $extra_charge = [
            (object)[
                'name' => 'Biaya Pengantaran',
                'price' => 5000
            ],
            (object)[
                'name' => 'Pajak',
                'price' => 3000
            ],
        ];

        $without_discount_price = array_sum(array_map(fn($item) => $item->subtotal, $carts));
        $total_extra_charge = array_sum(array_map(fn($item) => $item->price, $extra_charge));
        $discount_price = 0; // Misalnya kupon diskon Rp 10.000
        $total_price = ($without_discount_price + $total_extra_charge) - $discount_price;

        return view('customer.keranjang', compact(
            'carts',
            'extra_charge',
            'total_price',
            'total_extra_charge',
            'without_discount_price',
            'discount_price',
            'alamatUser'
        ));
    }

    public function addToCart(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id' => 'required|exists:jamu,id_jamu',
            'qty' => 'required|integer|min:1',
        ]);

        // Ambil ID user saat ini (pastikan user sudah login)
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Tambahkan ke keranjang (bisa dikembangkan untuk cek duplikat)
        for ($i = 0; $i < $validated['qty']; $i++) {
            Keranjang::create([
                'id_jamu' => $validated['id'],
                'id_user' => $userId,
            ]);
        }

        return redirect()->to(route('cart.index'))
            ->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id_jamu)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $userId = Auth::id();
        $quantity = (int) $request->input('quantity');

        // Hapus semua entri produk ini di keranjang user
        Keranjang::where('id_user', $userId)
            ->where('id_jamu', $id_jamu)
            ->delete();

        // Tambahkan ulang sesuai jumlah baru
        $items = [];
        for ($i = 0; $i < $quantity; $i++) {
            $items[] = [
                'id_user' => $userId,
                'id_jamu' => $id_jamu,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Keranjang::insert($items);

        return redirect()->back()->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function delete($id_jamu)
    {
        $userId = Auth::id();

        // Hapus semua item dari keranjang user berdasarkan id_jamu
        Keranjang::where('id_user', $userId)
            ->where('id_jamu', $id_jamu)
            ->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function processCheckout(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'alamat_id' => 'required|exists:alamat,id_alamat'
        ]);

        // Gunakan alamat_id untuk order baru
        $alamatId = $request->input('alamat_id');

        if ($alamatId === 'add-new') {
            return redirect()->route('profile.edit')->with('info', 'Silakan tambah alamat terlebih dahulu.');
        }

        // Ambil item keranjang user beserta data jamunya
        $cartItems = Keranjang::with('jamu')
            ->where('id_user', $userId)
            ->get()
            ->groupBy('id_jamu');

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('wrong', 'Keranjang kamu kosong.');
        }

        DB::beginTransaction();

        try {
            // Hitung total
            $totalKeranjang = 0;
            foreach ($cartItems as $items) {
                $first = $items->first();
                $jumlah = $items->count();
                $totalKeranjang += ($first->jamu->harga ?? 0) * $jumlah;
            }

            // Biaya tambahan (opsional)
            $biayaPengantaran = 5000;
            $pajak = 3000;
            $diskon = 0;

            $totalTransaksi = ($totalKeranjang + $biayaPengantaran + $pajak) - $diskon;

            // Buat transaksi
            $transaksi = Transaksi::create([
                'tanggal_transaksi' => now(),
                'total_transaksi' => $totalTransaksi,
                'status_pembayaran' => 0, // 0 = belum bayar
                'id_user' => $userId,
            ]);

            // Simpan detil transaksi
            foreach ($cartItems as $items) {
                $first = $items->first();
                DetilTransaksi::create([
                    'id_transaksi' => $transaksi->id_transaksi,
                    'id_jamu' => $first->id_jamu,
                    'jumlah' => $items->count(),
                ]);
            }

            // Hapus isi keranjang setelah checkout
            Keranjang::where('id_user', $userId)->delete();

            DB::commit();
            return redirect()->route('pesanan.index')->with('success', 'Pesanan Ditambah!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('wrong', 'Terjadi kesalahan saat proses checkout.');
        }
    }
}
