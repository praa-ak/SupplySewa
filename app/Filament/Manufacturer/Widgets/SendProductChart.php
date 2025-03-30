<?php

namespace App\Filament\Manufacturer\Widgets;

use App\Models\ManifactureProduct;
use App\Models\Product;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class SendProductChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected  static ?int $sort = 2;
    protected int| array| string $columnSpan = 'full';


    protected function getData(): array
    {
        $products = [];

        foreach (range(1, 12) as $month) {
            $products[] = ManifactureProduct::where('manufacturer_id',Auth::guard('manufacturer')->user()->id)->where('status', 'approved')->whereMonth('created_at', $month)->whereYear('created_at', now()->year)->count();
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
        return 'bar';
    }
}
