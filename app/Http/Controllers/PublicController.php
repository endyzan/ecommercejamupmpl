<?php

namespace App\Http\Controllers;

use App\Models\Jamu;
use App\Models\KategoriJamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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

        DB::listen(function ($query) {
            logger($query->sql);
            logger($query->bindings);
        });

        // Inisialisasi query dengan relasi komentar
        $query = Jamu::query()
            ->withCount('komentar')
            ->withAvg('komentar', 'rating');

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
        $perPage = 20;
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
}
