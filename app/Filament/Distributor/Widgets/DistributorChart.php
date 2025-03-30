<?php

namespace App\Filament\Distributor\Widgets;

use App\Models\ManifactureProduct;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class DistributorChart extends ChartWidget
{
    protected static ?string $heading = 'Product Received';
    protected  static ?int $sort = 2;
    protected int| array| string $columnSpan = 'full';

    protected function getData(): array
    {
        $products = [];

        foreach (range(1, 12) as $month) {
            $products[] = ManifactureProduct::where('distributor_id',Auth::guard('distributor')->user()->id)->where('status', 'approved')->whereMonth('created_at', $month)->whereYear('created_at', now()->year)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Product Received',
                    'data' => $products,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
