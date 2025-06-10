<?php

namespace App\Http\Controllers;


use App\Models\Alamat;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');
        if (Auth::user()->role == 0) return redirect()->route('home');
        // Table
        $tabel_transaksi = Transaksi::with(['user', 'detilTransaksi.jamu'])
            ->limit(10)->orderBy('created_at', 'desc')->get();
        // Chart
        $range = $request->query('range', 90); // default 90 hari
        $startDate = Carbon::now()->subDays($range);
        $endDate = Carbon::now();

        $groupFormat = $range <= 7 ? '%d %b' : ($range <= 30 ? '%d %b' : '%b %Y');

        $chartData = Transaksi::select(
            DB::raw("DATE_FORMAT(tanggal_transaksi, '$groupFormat') as label"),
            DB::raw("SUM(total_transaksi) as total")
        )
            ->whereBetween('tanggal_transaksi', [$startDate, $endDate])
            ->where('status_pembayaran', 'lunas')
            ->groupBy('label')
            ->orderByRaw("MIN(tanggal_transaksi)")
            ->get();

        $labels = $chartData->pluck('label');
        $data = $chartData->pluck('total');
        // Twin
        $labelFormat = $range <= 7 ? '%d %b' : '%b %d';

        // Data pendapatan per label tanggal/bulan
        $revenueData = Transaksi::select(
            DB::raw("DATE_FORMAT(tanggal_transaksi, '$labelFormat') AS label"),
            DB::raw("SUM(total_transaksi) AS total")
        )
            ->whereBetween('tanggal_transaksi', [$startDate, $endDate])
            ->where('status_pembayaran', 'lunas')
            ->groupBy('label')
            ->orderByRaw("MIN(tanggal_transaksi)")
            ->pluck('total', 'label');

        // Total pendapatan keseluruhan
        $totalRevenue = $revenueData->sum();

        // Total unit yang terjual
        $totalUnits = Transaksi::join('detil_transaksi', 'transaksi.id_transaksi', '=', 'detil_transaksi.id_transaksi')
            ->whereBetween('tanggal_transaksi', [$startDate, $endDate])
            ->where('status_pembayaran', 'lunas')
            ->sum('detil_transaksi.jumlah');

        // Data unit terjual per kategori
        $categoryData = Transaksi::join('detil_transaksi', 'transaksi.id_transaksi', '=', 'detil_transaksi.id_transaksi')
            ->join('jamu', 'detil_transaksi.id_jamu', '=', 'jamu.id_jamu')
            ->join('kategori', 'jamu.id_kategori', '=', 'kategori.id_kategori')  // ganti kategori_jamus jadi kategori dan join biasa
            ->select('kategori.nama_kategori as category', DB::raw('SUM(detil_transaksi.jumlah) as units'))
            ->whereBetween('tanggal_transaksi', [$startDate, $endDate])
            ->where('status_pembayaran', 'lunas')
            ->groupBy('kategori.id_kategori')
            ->pluck('units', 'category');


        return view('admin.dashboard', compact(
            'tabel_transaksi',
            'labels',
            'data',
            'range',
            'startDate',
            'endDate',
            'revenueData',
            'totalRevenue',
            'totalUnits',
            'categoryData',
        ));
    }

    public function ManageTransaksi(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');
        if (Auth::user()->role == 0) return redirect()->route('home');

        $transaksi = Transaksi::with(['user', 'detilTransaksi.jamu'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.manajementransaksi', compact('transaksi'));
    }

    public function kirimPesanan(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Ubah status pembayaran jadi 2 Dikirim
        $transaksi->status_pembayaran = 2;
        $transaksi->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dikirim!');
    }
    public function cancelPesanan(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->status_pembayaran = 4; // Dibatalkan
        $transaksi->save();

        return redirect()->back()->with('success', 'Pesanan dibatalkan!');
    }
    public function showTransactionDetail($id)
    {
        $transaksi = Transaksi::with(['user.alamat', 'detilTransaksi.jamu'])->findOrFail($id);
        $alamatUser = Alamat::where('id_user', $transaksi->id_user)->get();
        $biayaPengantaran = 5000;
        $pajak = 3000;

        return view('admin.components.transactions.seedetails', compact(
            'transaksi',
            'alamatUser',
            'biayaPengantaran',
            'pajak'
        ));
    }
}


// $status = [
//     0 => [
//         'label' => 'Belum Bayar',
//         'class' => 'bg-yellow-100 text-yellow-800',
//     ],
//     1 => ['label' => 'Dikemas', 'class' => 'bg-blue-100 text-blue-800'],
//     2 => ['label' => 'Dikirim', 'class' => 'bg-indigo-100 text-indigo-800'],
//     3 => ['label' => 'Diterima', 'class' => 'bg-green-100 text-green-800'],
//     4 => ['label' => 'Dibatalkan', 'class' => 'bg-red-100 text-red-800'],
// ];
