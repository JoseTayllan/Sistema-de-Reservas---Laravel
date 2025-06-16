<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reservas PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Relatório de Reservas</h2>

    <table>
        <thead>
            <tr>
                <th>Usuário</th>
                <th>Espaço</th>
                <th>Data</th>
                <th>Hora Início</th>
                <th>Hora Fim</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->user->name }}</td>
                    <td>{{ $reserva->espaco->nome }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva->data)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva->horario_inicio)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reserva->horario_fim)->format('H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
