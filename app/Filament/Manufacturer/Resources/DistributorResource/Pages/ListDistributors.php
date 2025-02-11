<?php

namespace App\Filament\Manufacturer\Resources\DistributorResource\Pages;

use App\Filament\Manufacturer\Resources\DistributorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistributors extends ListRecords
{
    protected static string $resource = DistributorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
