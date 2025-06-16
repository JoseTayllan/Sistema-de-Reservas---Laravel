<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class AdminReservaController extends Controller
{
    public function index(Request $request)
{
    $query = \App\Models\Reserva::with('user', 'espaco')->orderBy('data', 'desc');

    if ($request->filled('user')) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->user . '%');
        });
    }

    if ($request->filled('espaco')) {
        $query->whereHas('espaco', function ($q) use ($request) {
            $q->where('nome', 'like', '%' . $request->espaco . '%');
        });
    }

    if ($request->filled('data')) {
        $query->whereDate('data', $request->data);
    }

    $reservas = $query->get();

    return view('admin.reservas.index', compact('reservas'));
}
public function edit($id)
{
    $reserva = Reserva::findOrFail($id);
    $espacos = \App\Models\Espaco::all();
    $usuarios = \App\Models\User::all();

    return view('admin.reservas.edit', compact('reserva', 'espacos', 'usuarios'));
}

public function update(Request $request, $id)
{
    $reserva = Reserva::findOrFail($id);

    $request->validate([
        'user_id' => 'required|exists:users,id',
        'espaco_id' => 'required|exists:espacos,id',
        'data' => 'required|date',
        'horario_inicio' => 'required',
        'horario_fim' => 'required|after:horario_inicio',
    ]);

    $reserva->update($request->all());

    return redirect()->route('admin.reservas.index')->with('success', 'Reserva atualizada com sucesso.');
}

public function destroy($id)
{
    $reserva = Reserva::findOrFail($id);
    $reserva->delete();

    return redirect()->route('admin.reservas.index')->with('success', 'Reserva excluída com sucesso.');
}

}
