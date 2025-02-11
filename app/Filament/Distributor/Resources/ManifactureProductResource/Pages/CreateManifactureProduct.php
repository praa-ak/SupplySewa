<?php

namespace App\Filament\Distributor\Resources\ManifactureProductResource\Pages;

use App\Filament\Distributor\Resources\ManifactureProductResource;
use App\Models\ManifactureProduct;
use Faker\Provider\ar_EG\Text;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;

class CreateManifactureProduct extends CreateRecord
{
    use HasWizard;
    protected static string $resource = ManifactureProductResource::class;

    
}
