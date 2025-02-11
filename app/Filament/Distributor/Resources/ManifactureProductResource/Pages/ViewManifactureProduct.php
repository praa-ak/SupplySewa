<?php

namespace App\Filament\Distributor\Resources\ManifactureProductResource\Pages;

use App\Filament\Distributor\Resources\ManifactureProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewManifactureProduct extends ViewRecord
{
    protected static string $resource = ManifactureProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
