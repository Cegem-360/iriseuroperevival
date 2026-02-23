<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\ActivitySignup;
use App\Models\Workshop;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class ActivitySignupForm extends Component
{
    public string $activityType;

    public ?int $workshopId = null;

    public string $firstName = '';

    public string $lastName = '';

    public string $email = '';

    public string $phone = '';

    public string $notes = '';

    public bool $submitted = false;

    /** @var array<string, string> */
    protected array $activityLabels = [
        'workshop' => 'Workshop',
        'healing_room' => 'Healing Room',
        'prophetic_room' => 'Prophetic Room',
        'street_evangelism' => 'Street Evangelism',
    ];

    public function mount(string $activityType, ?int $workshopId = null): void
    {
        $this->activityType = $activityType;
        $this->workshopId = $workshopId;
    }

    /**
     * @return array<string, array<int, string>>
     */
    protected function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:100'],
            'lastName' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'workshopId' => ['nullable', 'exists:workshops,id'],
        ];
    }

    public function submit(): void
    {
        $this->validate();

        ActivitySignup::query()->create([
            'activity_type' => $this->activityType,
            'workshop_id' => $this->workshopId,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'notes' => $this->notes,
        ]);

        $this->submitted = true;
    }

    public function getActivityLabel(): string
    {
        return $this->activityLabels[$this->activityType] ?? $this->activityType;
    }

    public function getWorkshops(): Collection
    {
        return Workshop::query()
            ->where('is_published', true)
            ->orderBy('title')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.activity-signup-form', [
            'activityLabel' => $this->getActivityLabel(),
            'workshops' => $this->activityType === 'workshop' ? $this->getWorkshops() : collect(),
        ]);
    }
}
