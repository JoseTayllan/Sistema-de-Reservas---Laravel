<?php

namespace App\Http\Controllers;

use App\Models\Espaco;
use Illuminate\Http\Request;

class EspacoController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $espacos = Espaco::all();
        return view('espacos.index', compact('espacos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('espacos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string|max:500',
            'capacidade' => 'required|integer|min:1',
            'horario_abertura' => 'required|date_format:H:i',
            'horario_fechamento' => 'required|date_format:H:i|after:horario_abertura',
        ]);
        Espaco::create($request->all());

        return redirect()->route('espacos.index')->with('success', 'Espaço criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Espaco $espaco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Espaco $espaco)
    {
        return view('espacos.edit', compact('espaco'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Espaco $espaco)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'capacidade' => 'required|integer|min:1',
            'horario_abertura' => 'required',
            'horario_fechamento' => 'required',
        ]);

        $espaco->update($request->all());

        return redirect()->route('espacos.index')->with('success', 'Espaço atualizado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Espaco $espaco)
    {
        $espaco->delete();
        return redirect()->route('espacos.index')->with('success', 'Espaço excluído com sucesso!');
    }
}
