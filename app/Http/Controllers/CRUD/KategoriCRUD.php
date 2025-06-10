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
}
