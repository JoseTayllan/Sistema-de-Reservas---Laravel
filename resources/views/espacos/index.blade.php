<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Espaços Cadastrados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @if (session('success'))
                    <div class="mb-4 text-green-600">{{ session('success') }}</div>
                @endif

                <a href="{{ route('espacos.create') }}" class="text-blue-600 underline mb-4 inline-block">
                    + Novo Espaço
                </a>

                <table class="w-full border text-left">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Nome</th>
                            <th class="border px-4 py-2">Capacidade</th>
                            <th class="border px-4 py-2">Horário</th>
                            <th class="border px-4 py-2">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($espacos as $espaco)
                            <tr>
                                <td class="border px-4 py-2">{{ $espaco->nome }}</td>
                                <td class="border px-4 py-2">{{ $espaco->capacidade }}</td>
                                <td class="border px-4 py-2">
                                    {{ $espaco->horario_abertura }} às {{ $espaco->horario_fechamento }}
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('espacos.edit', $espaco) }}" class="text-blue-500">Editar</a>
                                    <form action="{{ route('espacos.destroy', $espaco) }}" method="POST" class="inline ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600" onclick="return confirm('Tem certeza?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
