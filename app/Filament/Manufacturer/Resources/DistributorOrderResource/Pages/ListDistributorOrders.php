<?php

namespace App\Filament\Manufacturer\Resources\DistributorOrderResource\Pages;

use App\Filament\Manufacturer\Resources\DistributorOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDistributorOrders extends ListRecords
{
    protected static string $resource = DistributorOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
           
        ];
    }
}
