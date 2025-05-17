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
}
