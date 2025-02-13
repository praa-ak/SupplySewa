<?php

namespace App\Filament\Distributor\Widgets;

use Filament\Widgets\ChartWidget;

class DistributorChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected  static ?int $sort = 2;
    protected int| array| string $columnSpan = 'full';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
