<?php

declare(strict_types=1);

namespace App\Exports;

use App\Models\Registration;
use BackedEnum;
use Carbon\CarbonInterface;
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
    /**
     * Every column of the registrations table, mapped to its export heading.
     *
     * @var array<string, string>
     */
    protected const COLUMNS = [
        'id' => 'ID',
        'uuid' => 'UUID',
        'user_id' => 'User ID',
        'type' => 'Type',
        'status' => 'Status',
        'locale' => 'Locale',

        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'country' => 'Country',
        'city' => 'City',

        'ticket_type' => 'Ticket Type',
        'ticket_day' => 'Ticket Day',
        'ticket_quantity' => 'Quantity',
        'is_group_ticket' => 'Group Ticket',
        'amount' => 'Amount (EUR)',
        'wants_to_evangelize' => 'Wants To Evangelize',
        'want_to_healing_room' => 'Wants Healing Room',
        'want_to_prophet_room' => 'Wants Prophetic Room',

        'service_areas' => 'Service Areas',
        'has_served_before' => 'Has Served Before',
        'previous_service_description' => 'Previous Service Description',

        'citizenship' => 'Citizenship',
        'languages' => 'Languages',
        'occupation' => 'Occupation',
        'ministry_areas' => 'Ministry Areas',
        'church_name' => 'Church Name',
        'church_city' => 'Church City',
        'pastor_name' => 'Pastor Name',
        'pastor_email' => 'Pastor Email',
        'is_born_again' => 'Born Again',
        'is_spirit_filled' => 'Spirit Filled',
        'testimony' => 'Testimony',
        'attended_ministry_school' => 'Attended Ministry School',
        'ministry_school_name' => 'Ministry School Name',

        'reference_1_name' => 'Reference 1 Name',
        'reference_1_email' => 'Reference 1 Email',
        'reference_1_contacted_at' => 'Reference 1 Contacted At',
        'reference_1_status' => 'Reference 1 Status',
        'reference_1_response' => 'Reference 1 Response',
        'reference_1_responded_at' => 'Reference 1 Responded At',

        'reference_2_name' => 'Reference 2 Name',
        'reference_2_email' => 'Reference 2 Email',
        'reference_2_contacted_at' => 'Reference 2 Contacted At',
        'reference_2_status' => 'Reference 2 Status',
        'reference_2_response' => 'Reference 2 Response',
        'reference_2_responded_at' => 'Reference 2 Responded At',

        'invited_by' => 'Invited By',
        'confirmation_email_sent_at' => 'Confirmation Email Sent At',

        'stripe_customer_id' => 'Stripe Customer ID',
        'stripe_session_id' => 'Stripe Session ID',
        'stripe_payment_intent' => 'Stripe Payment Intent',
        'paid_at' => 'Paid At',

        'approved_at' => 'Approved At',
        'approved_by' => 'Approved By',
        'rejected_at' => 'Rejected At',
        'rejected_by' => 'Rejected By',
        'rejection_reason' => 'Rejection Reason',
        'admin_notes' => 'Admin Notes',

        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
    ];

    /**
     * Columns holding a boolean flag, rendered as Yes/No.
     *
     * @var list<string>
     */
    protected const BOOLEAN_COLUMNS = [
        'is_group_ticket',
        'wants_to_evangelize',
        'want_to_healing_room',
        'want_to_prophet_room',
        'has_served_before',
        'is_born_again',
        'is_spirit_filled',
        'attended_ministry_school',
    ];

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

    /**
     * @return list<string>
     */
    public function headings(): array
    {
        return array_values(self::COLUMNS);
    }

    /**
     * @param  Registration  $registration
     * @return list<string|int|float|null>
     */
    public function map($registration): array
    {
        $row = [];

        foreach (array_keys(self::COLUMNS) as $column) {
            $row[] = $this->formatValue($registration, $column);
        }

        return $row;
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

    protected function formatValue(Registration $registration, string $column): string|int|float|null
    {
        $value = $registration->getAttribute($column);

        if ($column === 'amount') {
            return $value === null ? '' : Number::format((float) $value / 100, 2);
        }

        if (in_array($column, self::BOOLEAN_COLUMNS, true)) {
            return $value === null ? '' : ($value ? 'Yes' : 'No');
        }

        return match (true) {
            $value === null => '',
            $value instanceof CarbonInterface => $value->format('Y-m-d H:i'),
            $value instanceof BackedEnum => (string) $value->value,
            is_array($value) => implode(', ', array_map(static fn ($item): string => is_scalar($item) ? (string) $item : json_encode($item), $value)),
            is_bool($value) => $value ? 'Yes' : 'No',
            default => $value,
        };
    }
}
