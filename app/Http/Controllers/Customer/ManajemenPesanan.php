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
use Illuminate\Support\Facades\Auth;

class ManajemenPesanan extends Controller
{
    function index()
    {
        $orders = Transaksi::where('id_user', Auth::id())
            ->where('status_pembayaran', '!=', 4)
            ->orderBy('tanggal_transaksi', 'desc')
            ->paginate(10);

        return view('customer.pesanan', compact('orders'));
    }


    function showOrderDetail($id)
    {
        $transaksi = Transaksi::with(['user.alamat', 'detilTransaksi.jamu'])->findOrFail($id);
        $alamatUser = Alamat::where('id_user', $transaksi->id_user)->get();
        $biayaPengantaran = 5000;
        $pajak = 3000;

        return view('customer.pesanandetail', compact(
            'transaksi',
            'alamatUser',
            'biayaPengantaran',
            'pajak'
        ));
    }

    public function submitOrder($id)
    {
        $transaksi = Transaksi::where('id_transaksi', $id)
            ->where('id_user', Auth::id())
            ->firstOrFail();

        if ($transaksi->status_pembayaran != 0) {
            return redirect()->back()->with('wrong', 'Pesanan ini sudah dibayar.');
        }

        $transaksi->status_pembayaran = 1;
        $transaksi->save();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dibayar.');
    }

    public function completeOrder(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->status_pembayaran = 3; // Selesai
        $transaksi->save();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan Sudah Diterima!');
    }
    public function cancelOrder(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->status_pembayaran = 4; // Dibatalkan
        $transaksi->save();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan Sudah Di Batalkan!');
    }

    public function trackOrder($id)
    {
        $transaksi = Transaksi::with(['user', 'detilTransaksi.jamu'])->findOrFail($id);
        // Tambahkan nilai biaya dan pajak
        $biayaPengantaran = 5000;
        $pajak = 3000;

        return view('customer.lacakpesanan', compact('transaksi', 'biayaPengantaran', 'pajak'));
    }
}
