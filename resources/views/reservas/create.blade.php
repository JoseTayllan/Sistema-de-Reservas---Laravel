<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">Nova Reserva</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow-sm">
                @if ($errors->any())
                    <ul class="text-red-600 mb-4">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form action="{{ route('reservas.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block">Espaço:</label>
                        <select name="espaco_id" class="w-full border p-2 rounded">
                            @foreach ($espacos as $espaco)
                                <option value="{{ $espaco->id }}">{{ $espaco->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block">Data:</label>
                        <input type="date" name="data" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block">Horário de Início:</label>
                        <input type="time" name="horario_inicio" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block">Horário de Fim:</label>
                        <input type="time" name="horario_fim" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('reservas.index') }}" class="text-gray-600">Cancelar</a>
                        <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded">Reservar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
