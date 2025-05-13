<?php

namespace App\Http\Controllers;

use App\Models\Noivo;
use App\Models\Padrinho;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {

        $totalNoivos = Noivo::count();
        $totalPadrinhos = Padrinho::count();
        $mediaPadrinhosPorNoivo = $totalNoivos > 0 ? round($totalPadrinhos / $totalNoivos, 1) : 0;


        $eventosHoje = Noivo::whereDate('datadoevento', Carbon::today())->count();
        $proximosEventosCount = Noivo::whereBetween('datadoevento', [Carbon::today(), Carbon::today()->addDays(30)])->count();


        $proximosEventos = Noivo::withCount('padrinhos')
            ->where('datadoevento', '>', Carbon::now())
            ->orderBy('datadoevento')
            ->take(3)
            ->get();

  
        $padrinhosRecentes = Padrinho::with('noivo')
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'totalNoivos',
            'totalPadrinhos',
            'mediaPadrinhosPorNoivo',
            'eventosHoje',
            'proximosEventosCount',
            'proximosEventos',
            'padrinhosRecentes'
        ));
    }
}
