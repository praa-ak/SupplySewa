<?php

namespace App\Filament\Manufacturer\Resources\ManifactureProductResource\Pages;

use App\Filament\Manufacturer\Resources\ManifactureProductResource;
use Filament\Actions;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

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
