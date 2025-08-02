<?php

namespace App\Http\Controllers;

use App\Models\DipoKereta;
use App\Models\DipoLokomotif;
use Illuminate\Http\Request;

class DashboardDipoController extends Controller
{
    public function index()
    {
        $totalDipoLokomotif = DipoLokomotif::count();
        $totalDipoKereta = DipoKereta::count();

        return view('dashboard-master-dipo', compact(
            'totalDipoLokomotif',
            'totalDipoKereta',
        ));
    }
}
