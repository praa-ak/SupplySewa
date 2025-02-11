<?php

namespace App\Filament\Distributor\Resources\RetailerResource\Pages;

use App\Filament\Distributor\Resources\RetailerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRetailers extends ListRecords
{
    protected static string $resource = RetailerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
