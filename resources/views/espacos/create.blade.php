<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Espaço') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('espacos.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block">Nome:</label>
                        <input type="text" name="nome" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block">Descrição:</label>
                        <textarea name="descricao" class="w-full border rounded p-2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block">Capacidade:</label>
                        <input type="number" name="capacidade" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block">Horário de Abertura:</label>
                        <input type="time" name="horario_abertura" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label class="block">Horário de Fechamento:</label>
                        <input type="time" name="horario_fechamento" class="w-full border rounded p-2" required>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('espacos.index') }}" class="text-gray-600">Cancelar</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
