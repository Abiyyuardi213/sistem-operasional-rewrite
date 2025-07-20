<?php

namespace App\Http\Controllers;

use App\Models\Kantor;
use App\Models\Kota;
use App\Models\Pulau;
use Illuminate\Http\Request;

class DashboardMasterController extends Controller
{
    public function index()
    {
        $totalPulau = Pulau::count();
        $totalKota = Kota::count();
        $totalKantor = Kantor::count();

        return view('dashboard-master', compact(
            'totalPulau',
            'totalKota',
            'totalKantor',
        ));
    }
}
