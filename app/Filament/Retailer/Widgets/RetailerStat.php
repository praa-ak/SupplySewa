<?php

namespace App\Filament\Retailer\Widgets;

use App\Models\DistributorProduct;
use App\Models\RetailerOrder;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class RetailerStat extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', DistributorProduct::where('retailer_id', Auth::guard('retailer')->user()->id)->where('status', 'approved')->count()),
            Stat::make('My Order', RetailerOrder::where('retailer_id', Auth::guard('retailer')->user()->id)->count()),
        ];
    }
}
