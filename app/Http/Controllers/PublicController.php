<?php

namespace App\Http\Controllers;

use App\Models\Jamu;
use App\Models\KategoriJamu;
use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;



class PublicController extends Controller
{
    // Home
    public function index()
    {
        $jamus = Jamu::with('komentar')->get(); // Eager load komentar

        $jamus->transform(function ($jamu) {
            // Pastikan komentar sudah ada, kemudian hitung rating
            $total_rate = $jamu->komentar->sum('rating');
            $total_voter = $jamu->komentar->count();

            $per_rate = $total_voter > 0 ? $total_rate / $total_voter : 0;
            $per_rate = number_format($per_rate, 1);

            $jamu->rating = $per_rate;
            $jamu->whole = floor($per_rate);
            $jamu->fraction = $per_rate - floor($per_rate);

            return $jamu;
        });

        return view('home', compact('jamus'));
    }


    // Produk
    public function showProduct(Request $request)
    {
        // Inisialisasi query dengan relasi komentar
        $query = Jamu::query()
            ->withCount('komentar')
            ->withAvg('komentar', 'rating');

        // ✅ Filter berdasarkan pencarian nama jamu
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_jamu', 'like', '%' . $searchTerm . '%')
                ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
            });
        }


        // ✅ Filter berdasarkan kategori dari kolom JSON `id_kategori`
        if ($request->filled('kategori')) {
            $kategori = (array) $request->input('kategori');

            $query->where(function ($q) use ($kategori) {
                foreach ($kategori as $id) {
                    $q->orWhereRaw('JSON_CONTAINS(id_kategori, ?, "$")', strval($id));
                }
            });
        }


        // ✅ Ambil semua data jamu terlebih dahulu (belum dipaginate)
        $jamus = $query->get();

        // ✅ Format rating dan pecah jadi komponen rating
        $jamus = $jamus->map(function ($jamu) {
            $avgRating = $jamu->komentar_avg_rating ?? 0;
            $avgRating = number_format($avgRating, 1);

            $jamu->rating = (float) $avgRating;
            $jamu->whole = floor($jamu->rating);
            $jamu->fraction = $jamu->rating - $jamu->whole;

            return $jamu;
        });

        // ✅ Filter berdasarkan rating jika ada input
        if ($request->filled('rating')) {
            $jamus = $jamus->filter(function ($jamu) use ($request) {
                return $jamu->rating >= $request->input('rating');
            })->values(); // reset index
        }

        // ✅ Paginasi manual setelah filter
        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $pagedJamus = $jamus->forPage($currentPage, $perPage);
        $jamusPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedJamus,
            $jamus->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Ambil semua kategori
        $kategoris = KategoriJamu::all();

        // Kirim ke view
        return view('product.index', [
            'jamus' => $jamusPaginated,
            'kategoris' => $kategoris,
        ]);
    }

    // Detail Produk
    public function showProductDetail($id)
    {
        $jamu = Jamu::select('*')->with(['komentar' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->findOrFail($id);

        // Hitung rating
        $total_rate = $jamu->komentar->sum('rating');
        $total_voter = $jamu->komentar->count();

        $per_rate = $total_voter > 0 ? $total_rate / $total_voter : 0;
        $per_rate = number_format($per_rate, 1);

        $jamu->rating = $per_rate; // Rata-rata rating
        $jamu->whole = floor($per_rate); // Bulatkan rating
        $jamu->fraction = $per_rate - floor($per_rate); // Pecahan rating
        $jamu->reviewers = $total_voter; // Total Voters

        // Hitung jumlah rating per bintang
        $fivestar = $jamu->komentar->where('rating', 5)->count();
        $fourstar = $jamu->komentar->where('rating', 4)->count();
        $threestar = $jamu->komentar->where('rating', 3)->count();
        $twostar = $jamu->komentar->where('rating', 2)->count();
        $onestar = $jamu->komentar->where('rating', 1)->count();
        $jamu->rating_count = [
            '5' => $fivestar,
            '4' => $fourstar,
            '3' => $threestar,
            '2' => $twostar,
            '1' => $onestar,
        ];
        foreach ($jamu->komentar as $komentar) {
            $komentar->nama_user = DB::table('users')
                ->where('id', $komentar->id_user)
                ->value('name') ?? 'pengguna' . random_int(111111, 999999);
        }

        return view('product.product', compact('jamu'));
    }
}
