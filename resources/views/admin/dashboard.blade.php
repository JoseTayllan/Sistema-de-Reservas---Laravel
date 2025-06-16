@php
    $labels = $reservasPorDia->pluck('dia')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d/m'))->toArray();
    $valores = $reservasPorDia->pluck('total')->toArray();
@endphp

<x-layouts.admin>
    {{-- Cabeçalho com exportações responsivas --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            📋 Painel de Controle (Admin)
        </h2>
        <div class="flex flex-col sm:flex-row gap-2">
            <a href="{{ route('admin.export.excel') }}"
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow text-sm text-center">
                📊 Exportar Excel
            </a>
            <a href="{{ route('admin.export.pdf') }}"
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow text-sm text-center">
                🧾 Exportar PDF
            </a>
        </div>
    </div>

    {{-- Cards de resumo --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="text-sm text-gray-500">Total de Reservas</h3>
            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $totalReservas }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="text-sm text-gray-500">Espaço Mais Reservado</h3>
            <p class="text-lg mt-1">
                {{ $espacoMaisReservado?->espaco->nome ?? '-' }}<br>
                <span class="text-sm text-gray-600">({{ $espacoMaisReservado?->total ?? 0 }} reservas)</span>
            </p>
        </div>
        <div class="bg-white p-6 rounded shadow text-center">
            <h3 class="text-sm text-gray-500">Usuário Mais Ativo</h3>
            <p class="text-lg mt-1">
                {{ $usuarioMaisAtivo?->user->name ?? '-' }}<br>
                <span class="text-sm text-gray-600">({{ $usuarioMaisAtivo?->total ?? 0 }} reservas)</span>
            </p>
        </div>
    </div>

    {{-- Gráfico de reservas por dia --}}
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-md font-semibold mb-4">📈 Reservas por Dia</h3>
        <div class="relative w-full overflow-x-auto">
            <div class="w-full" style="min-width: 300px; max-width: 100%; height: 350px;">
                <canvas id="chartReservasPorDia"></canvas>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('chartReservasPorDia').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Reservas',
                        data: {!! json_encode($valores) !!},
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-layouts.admin>
