<?php

namespace App\Http\Controllers;

use App\Exports\ReservaExport;
use Illuminate\Support\Facades\View;
use App\Models\Reserva;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AdminExportController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new ReservaExport, 'reservas.xlsx');
    }

    public function exportPdf()
    {
        $reservas = Reserva::with(['user', 'espaco'])->get();

        $pdf = Pdf::loadView('admin.reservas.pdf', compact('reservas'));
        return $pdf->download('reservas.pdf');
    }
}
