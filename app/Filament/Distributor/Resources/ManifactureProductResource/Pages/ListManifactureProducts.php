<?php

namespace App\Filament\Distributor\Resources\ManifactureProductResource\Pages;

use App\Filament\Distributor\Resources\ManifactureProductResource;
use App\Models\ManifactureProduct;
use Filament\Actions;
use Filament\Actions\Action;
use Illuminate\Contracts\View\View;

use Filament\Resources\Pages\ListRecords;

class ListManifactureProducts extends ListRecords
{
    protected static string $resource = ManifactureProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Scan-Qr-Code')
            ->url('/qr-scan'),
            // Action::make('Manual Receive')
            // ->modalHeading('Receive Product')
            // ->modalSubmitActionLabel('Save')
            // ->modalContent(fn(ManifactureProduct $manifactureProduct): View => view('filament.distributor.receiveProduct', compact('manifactureProduct'))),
        ];
    }
}
