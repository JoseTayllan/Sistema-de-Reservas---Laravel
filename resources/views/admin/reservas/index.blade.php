<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Todas as Reservas (Admin)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Filtros responsivos --}}
            <form method="GET" action="{{ route('admin.reservas.index') }}" class="mb-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                <input type="text" name="user" placeholder="Usuário" value="{{ request('user') }}"
                    class="border px-3 py-2 rounded w-full" />

                <input type="text" name="espaco" placeholder="Espaço" value="{{ request('espaco') }}"
                    class="border px-3 py-2 rounded w-full" />

                <input type="date" name="data" value="{{ request('data') }}"
                    class="border px-3 py-2 rounded w-full" />

                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.reservas.index') }}" class="text-sm text-gray-500 self-center underline">
                        Limpar
                    </a>
                </div>
            </form>

            {{-- Tabela responsiva --}}
            <div class="overflow-x-auto bg-white shadow-md rounded p-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Usuário</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Espaço</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Data</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Horário</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($reservas as $reserva)
                        <tr>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $reserva->user->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $reserva->espaco->nome }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $reserva->data }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">
                                {{ \Carbon\Carbon::parse($reserva->horario_inicio)->format('H:i') }}
                                às
                                {{ \Carbon\Carbon::parse($reserva->horario_fim)->format('H:i') }}
                            </td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('admin.reservas.edit', $reserva->id) }}" class="text-blue-500 hover:underline">Editar</a>

                                <form action="{{ route('admin.reservas.destroy', $reserva->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">Nenhuma reserva encontrada.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>