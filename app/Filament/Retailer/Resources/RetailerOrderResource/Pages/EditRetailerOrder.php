<?php

namespace App\Filament\Retailer\Resources\RetailerOrderResource\Pages;

use App\Filament\Retailer\Resources\RetailerOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRetailerOrder extends EditRecord
{
    protected static string $resource = RetailerOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
