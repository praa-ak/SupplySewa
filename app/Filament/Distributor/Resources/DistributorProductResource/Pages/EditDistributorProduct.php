<?php

namespace App\Filament\Distributor\Resources\DistributorProductResource\Pages;

use App\Filament\Distributor\Resources\DistributorProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributorProduct extends EditRecord
{
    protected static string $resource = DistributorProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
