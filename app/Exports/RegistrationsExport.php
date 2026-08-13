<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Number;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegistrationsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles
{
    public function __construct(
        protected ?Collection $records = null,
        protected array $filters = [],
    ) {}

    public function collection(): Collection
    {
        if ($this->records) {
            return $this->records;
        }

        $query = Registration::query();

        if (! empty($this->filters['type'])) {
            $query->where('type', $this->filters['type']);
        }

        if (! empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'UUID',
            'Type',
            'Status',
            'First Name',
            'Last Name',
            'Email',
            'Phone',
            'Country',
            'City',
            'Ticket Type',
            'Ticket Day',
            'Quantity',
            'Amount (EUR)',
            'Paid At',
            'Created At',
            'Church Name',
            'Pastor Name',
            'Languages',
        ];
    }

    /**
     * @param  Registration  $registration
     */
    public function map($registration): array
    {
        return [
            $registration->id,
            $registration->uuid,
            $registration->type,
            $registration->status,
            $registration->first_name,
            $registration->last_name,
            $registration->email,
            $registration->phone,
            $registration->country?->value,
            $registration->city,
            $registration->ticket_type,
            $registration->ticket_day,
            $registration->ticket_quantity,
            $registration->amount ? Number::format($registration->amount / 100, 2) : '',
            $registration->paid_at?->format('Y-m-d H:i'),
            $registration->created_at->format('Y-m-d H:i'),
            $registration->church_name,
            $registration->pastor_name,
            is_array($registration->languages) ? implode(', ', $registration->languages) : $registration->languages,
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E2E8F0'],
                ],
            ],
        ];
    }
}
