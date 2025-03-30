<?php

namespace App\Filament\Distributor\Widgets;

use App\Models\DistributorProduct;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class ProductSent extends ChartWidget
{
    protected static ?string $heading = 'Product Sent';

    protected function getData(): array
    {
        $products = [];

        foreach (range(1, 12) as $month) {
            $products[] = DistributorProduct::where('distributor_id',Auth::guard('distributor')->user()->id)->where('status', 'approved')->whereMonth('created_at', $month)->whereYear('created_at', now()->year)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Product Sent',
                    'data' => $products,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
