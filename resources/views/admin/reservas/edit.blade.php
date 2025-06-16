<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Editar Reserva
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded">
                <form method="POST" action="{{ route('admin.reservas.update', $reserva->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">Usuário</label>
                        <select name="user_id" class="w-full border-gray-300 rounded mt-1">
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" @selected($reserva->user_id == $usuario->id)>
                                    {{ $usuario->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Espaço</label>
                        <select name="espaco_id" class="w-full border-gray-300 rounded mt-1">
                            @foreach($espacos as $espaco)
                                <option value="{{ $espaco->id }}" @selected($reserva->espaco_id == $espaco->id)>
                                    {{ $espaco->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Data</label>
                        <input type="date" name="data" class="w-full border-gray-300 rounded mt-1" value="{{ $reserva->data }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Horário Início</label>
                        <input type="time" name="horario_inicio" class="w-full border-gray-300 rounded mt-1" value="{{ $reserva->horario_inicio }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Horário Fim</label>
                        <input type="time" name="horario_fim" class="w-full border-gray-300 rounded mt-1" value="{{ $reserva->horario_fim }}">
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
