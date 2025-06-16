<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalReservas = Reserva::count();

        $espacoMaisReservado = Reserva::select('espaco_id', DB::raw('COUNT(*) as total'))
            ->groupBy('espaco_id')
            ->orderByDesc('total')
            ->with('espaco')
            ->first();

        $usuarioMaisAtivo = Reserva::select('user_id', DB::raw('COUNT(*) as total'))
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->with('user')
            ->first();

        $reservasPorDia = Reserva::select(DB::raw('DATE(data) as dia'), DB::raw('COUNT(*) as total'))
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        return view('admin.dashboard', compact(
            'totalReservas',
            'espacoMaisReservado',
            'usuarioMaisAtivo',
            'reservasPorDia'
        ));
    }
}
