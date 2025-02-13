<?php

namespace App\Filament\Distributor\Resources\RetailerOrderResource\Pages;

use App\Filament\Distributor\Resources\RetailerOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRetailerOrders extends ListRecords
{
    protected static string $resource = RetailerOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
           
        ];
    }
}
