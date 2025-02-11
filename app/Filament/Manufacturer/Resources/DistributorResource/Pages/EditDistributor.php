<?php

namespace App\Filament\Manufacturer\Resources\DistributorResource\Pages;

use App\Filament\Manufacturer\Resources\DistributorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDistributor extends EditRecord
{
    protected static string $resource = DistributorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
