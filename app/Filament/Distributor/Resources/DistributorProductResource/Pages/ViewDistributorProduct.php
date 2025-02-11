<?php

namespace App\Filament\Distributor\Resources\DistributorProductResource\Pages;

use App\Filament\Distributor\Resources\DistributorProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDistributorProduct extends ViewRecord
{
    protected static string $resource = DistributorProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
