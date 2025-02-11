<?php

namespace App\Filament\Retailer\Resources\DistributorProductResource\Pages;

use App\Filament\Retailer\Resources\DistributorProductResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListDistributorProducts extends ListRecords
{
    protected static string $resource = DistributorProductResource::class;

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
