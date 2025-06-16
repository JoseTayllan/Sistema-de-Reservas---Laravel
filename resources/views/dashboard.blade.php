<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 leading-tight">
            Bem-vindo ao Sistema de Reservas
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-10">

            {{-- Bloco de boas-vindas --}}
            <div class="bg-white shadow rounded-lg p-6 text-center">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Olá, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600">Aqui você pode reservar espaços, visualizar suas reservas e acessar funcionalidades conforme seu perfil.</p>
            </div>

            {{-- Ações principais --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('reservas.index') }}" class="bg-blue-100 hover:bg-blue-200 text-center p-6 rounded-lg shadow hover:shadow-lg transition">
                    <p class="text-3xl mb-2">📅</p>
                    <p class="font-semibold text-blue-700">Minhas Reservas</p>
                </a>
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}" class="bg-green-100 hover:bg-green-200 text-center p-6 rounded-lg shadow hover:shadow-lg transition">
                        <p class="text-3xl mb-2">🛡️</p>
                        <p class="font-semibold text-green-700">Painel Admin</p>
                    </a>
                    <a href="{{ route('espacos.index') }}" class="bg-indigo-100 hover:bg-indigo-200 text-center p-6 rounded-lg shadow hover:shadow-lg transition">
                        <p class="text-3xl mb-2">🏢</p>
                        <p class="font-semibold text-indigo-700">Gerenciar Espaços</p>
                    </a>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
