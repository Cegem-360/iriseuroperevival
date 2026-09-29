<?php

declare(strict_types=1);

namespace App\Filament\Resources\ScheduleItems\Pages;

use App\Filament\Resources\ScheduleItems\ScheduleItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Override;

final class EditScheduleItem extends EditRecord
{
    protected static string $resource = ScheduleItemResource::class;

    #[Override]
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
