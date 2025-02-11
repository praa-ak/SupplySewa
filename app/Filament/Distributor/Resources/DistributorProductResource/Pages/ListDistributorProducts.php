<?php

namespace App\Filament\Distributor\Resources\DistributorProductResource\Pages;

use App\Filament\Distributor\Resources\DistributorProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistributorProducts extends ListRecords
{
    protected static string $resource = DistributorProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
