<?php 
namespace App\Exports;

use App\Models\Reserva;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReservaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Reserva::with(['user', 'espaco'])->get();
    }

    public function map($reserva): array
    {
        return [
            $reserva->user->name,
            $reserva->espaco->nome,
            $reserva->data,
            $reserva->horario_inicio,
            $reserva->horario_fim,
        ];
    }

    public function headings(): array
    {
        return [
            'Usuário',
            'Espaço',
            'Data',
            'Horário Início',
            'Horário Fim',
        ];
    }
}
?>