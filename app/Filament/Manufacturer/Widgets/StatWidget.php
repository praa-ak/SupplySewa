<?php

namespace App\Filament\Manufacturer\Widgets;

use App\Models\Distributor;
use App\Models\ManifactureProduct;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatWidget extends BaseWidget
{
    protected  static ?int $sort = 1;


    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::where('manufacturer_id', Auth::guard('manufacturer')->user()->id)->count()),
            Stat::make('Total Distributors', Distributor::where('manufacturer_id', Auth::guard('manufacturer')->user()->id)->count()),
            Stat::make('Pending Orders', ManifactureProduct::where('manufacturer_id', Auth::guard('manufacturer')->user()->id)->where('status', 'pending')->count()),
        ];
    }
}
