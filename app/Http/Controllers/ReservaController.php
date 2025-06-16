<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Espaco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::where('user_id', Auth::id())->get();
        return view('reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $espacos = Espaco::all();
        return view('reservas.create', compact('espacos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'espaco_id' => 'required|exists:espacos,id',
        'data' => 'required|date',
        'horario_inicio' => 'required|date_format:H:i',
        'horario_fim' => 'required|date_format:H:i|after:horario_inicio',
    ]);

    $conflito = Reserva::where('espaco_id', $request->espaco_id)
        ->where('data', $request->data)
        ->where(function ($query) use ($request) {
            $query->whereBetween('horario_inicio', [$request->horario_inicio, $request->horario_fim])
                  ->orWhereBetween('horario_fim', [$request->horario_inicio, $request->horario_fim]);
        })
        ->exists();

    if ($conflito) {
        return redirect()->back()->withErrors(['horario' => 'Este horário já está reservado para este espaço.'])->withInput();
    }

    Reserva::create([
        'user_id' => Auth::id(),
        'espaco_id' => $request->espaco_id,
        'data' => $request->data,
        'horario_inicio' => $request->horario_inicio,
        'horario_fim' => $request->horario_fim,
    ]);

    return redirect()->route('reservas.index')->with('success', 'Reserva criada com sucesso!');
}

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        if ($reserva->user_id !== Auth::id()) {
           abort(403, 'Você não tem permissão para excluir esta reserva.'); 
        }
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva excluída com sucesso!');
    }
}
