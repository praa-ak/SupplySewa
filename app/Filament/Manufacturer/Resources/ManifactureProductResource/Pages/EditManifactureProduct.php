<?php

namespace App\Filament\Manufacturer\Resources\ManifactureProductResource\Pages;

use App\Filament\Manufacturer\Resources\ManifactureProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManifactureProduct extends EditRecord
{
    protected static string $resource = ManifactureProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
