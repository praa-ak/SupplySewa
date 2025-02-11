<?php

namespace App\Filament\Distributor\Resources\RetailerResource\Pages;

use App\Filament\Distributor\Resources\RetailerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRetailer extends ViewRecord
{
    protected static string $resource = RetailerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
