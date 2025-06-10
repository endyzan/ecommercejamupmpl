<?php

namespace App\Http\Controllers\CRUD;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AkunAdminCRUD extends Controller
{
    public function index()
    {
        return view('admin.crud.akunadminmanage');
    }
}
