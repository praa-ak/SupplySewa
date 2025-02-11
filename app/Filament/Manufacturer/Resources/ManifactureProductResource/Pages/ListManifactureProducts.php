<?php

namespace App\Filament\Manufacturer\Resources\ManifactureProductResource\Pages;

use App\Filament\Manufacturer\Resources\ManifactureProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManifactureProducts extends ListRecords
{
    protected static string $resource = ManifactureProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
