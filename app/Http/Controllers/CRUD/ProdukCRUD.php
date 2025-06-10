<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Jamu;
use Illuminate\Support\Facades\Auth;

class ProdukCRUD extends Controller
{
    public function index()
    {
        $jamu = Jamu::paginate(10);
        return view('admin.crud.produkmanage', compact('jamu'));
    }
}
