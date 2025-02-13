<?php

namespace App\Filament\Distributor\Resources\DistributorOrderResource\Pages;

use App\Filament\Distributor\Resources\DistributorOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributorOrder extends EditRecord
{
    protected static string $resource = DistributorOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
