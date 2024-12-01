<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Lansia;
use App\Models\BukuTamu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'anak' => Anak::count(),
            'lansia' => Lansia::count(),
            'bukuTamu' => BukuTamu::count()
        ]);
    }
}
