<?php

namespace App\Filament\Distributor\Widgets;

use App\Models\DistributorOrder;
use App\Models\ManifactureProduct;
use App\Models\RetailerOrder;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class DistributorStat extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('My Order', DistributorOrder::where('distributor_id', Auth::guard('distributor')->user()->id)->count()),
            Stat::make('Retailer Order', RetailerOrder::where('distributor_id', Auth::guard('distributor')->user()->id)->count()),
            Stat::make('My Products', ManifactureProduct::where('distributor_id', Auth::guard('distributor')->user()->id)->where('status','approved')->count()),
        ];
    }
}
