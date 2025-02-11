<?php

namespace App\Filament\Retailer\Resources\DistributorProductResource\Pages;

use App\Filament\Retailer\Resources\DistributorProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributorProduct extends EditRecord
{
    protected static string $resource = DistributorProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
