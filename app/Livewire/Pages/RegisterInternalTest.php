<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

/**
 * Internal live-payment test registration page.
 *
 * Disposable: delete this file + RegistrationFormInternalTest + both blade views
 * + routes/web.php::register.internal-test + the add_is_test migration to fully
 * remove this feature. Not reachable without the admin-only secret route.
 */
#[Title('INTERNAL TEST — Europe Revival 2026')]
#[Layout('components.layouts.app')]
class RegisterInternalTest extends Component
{
    public string $title = 'INTERNAL TEST — Live Payment Flow';

    public string $subtitle = 'This page is not linked anywhere. Do not share the URL.';

    public function render(): View
    {
        return view('livewire.pages.register-internal-test');
    }
}
