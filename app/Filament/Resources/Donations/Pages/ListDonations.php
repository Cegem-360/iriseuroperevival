<?php

declare(strict_types=1);

namespace App\Filament\Resources\Donations\Pages;

use App\Filament\Resources\Donations\DonationResource;
use Filament\Resources\Pages\ListRecords;

final class ListDonations extends ListRecords
{
    protected static string $resource = DonationResource::class;
}
