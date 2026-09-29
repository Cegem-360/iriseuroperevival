<?php

declare(strict_types=1);

namespace App\Filament\Resources\PromotionCodes\Pages;

use App\Filament\Resources\PromotionCodes\PromotionCodeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Override;

final class EditPromotionCode extends EditRecord
{
    protected static string $resource = PromotionCodeResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
