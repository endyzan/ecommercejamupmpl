<?php

namespace App\Http\Controllers;


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
}
