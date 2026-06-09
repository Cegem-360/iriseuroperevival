<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Models\Registration;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Reference Confirmation - Europe Revival 2026')]
class ReferenceConfirmation extends Component
{
    public Registration $registration;

    public int $reference;

    public string $refereeName = '';

    public string $comment = '';

    public bool $submitted = false;

    public function mount(Registration $registration, int $reference): void
    {
        abort_unless(in_array($reference, [1, 2], true), 404);
        abort_unless($registration->type === 'ministry', 404);
        abort_unless(filled($registration->{"reference_{$reference}_email"}), 404);

        $this->registration = $registration;
        $this->reference = $reference;
        $this->refereeName = (string) $registration->{"reference_{$reference}_name"};
    }

    public function alreadyResponded(): bool
    {
        $status = $this->registration->{"reference_{$this->reference}_status"};

        return in_array($status, ['responded', 'approved', 'rejected'], true);
    }

    public function submit(bool $vouches): void
    {
        if ($this->alreadyResponded()) {
            return;
        }

        $comment = trim($this->comment);

        $this->registration->update([
            "reference_{$this->reference}_status" => $vouches ? 'approved' : 'rejected',
            "reference_{$this->reference}_response" => $comment !== '' ? $comment : null,
            "reference_{$this->reference}_responded_at" => now(),
        ]);

        $this->submitted = true;
    }

    public function render(): View
    {
        return view('livewire.pages.reference-confirmation');
    }
}
