<?php

declare(strict_types=1);

namespace App\Filament\Resources\TicketPrices\Pages;

use App\Filament\Resources\TicketPrices\TicketPriceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Override;

final class EditTicketPrice extends EditRecord
{
    protected static string $resource = TicketPriceResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
