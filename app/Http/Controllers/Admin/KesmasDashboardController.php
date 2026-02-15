<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KesmasRegistration;
use App\Models\KesmasResult;

class KesmasDashboardController extends Controller
{
    public function index()
    {
        $totalHariIni = KesmasRegistration::whereDate('created_at', today())->count();
        $totalMikro   = KesmasRegistration::where('jenis_pemeriksaan', 'like', '%mikro%')->count();
        $totalKimia   = KesmasRegistration::where('jenis_pemeriksaan', 'like', '%kimia%')->count();
        $totalLunas   = KesmasRegistration::where('status_pembayaran', 'lunas')->count();
        $totalBelum   = KesmasRegistration::where('status_pembayaran', 'belum_lunas')->count();

        $registrasiTerbaru = KesmasRegistration::latest()->take(10)->get();

        return view('kesmas.admin.dashboard.index', compact(
            'totalHariIni',
            'totalMikro',
            'totalKimia',
            'totalLunas',
            'totalBelum',
            'registrasiTerbaru'
        ));
    }
}
