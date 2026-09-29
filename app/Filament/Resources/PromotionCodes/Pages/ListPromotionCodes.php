<?php

declare(strict_types=1);

namespace App\Filament\Resources\PromotionCodes\Pages;

use App\Filament\Resources\PromotionCodes\PromotionCodeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Override;

final class ListPromotionCodes extends ListRecords
{
    protected static string $resource = PromotionCodeResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
