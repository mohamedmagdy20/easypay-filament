<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class InvestorChart extends ChartWidget
{
    protected static ?string $heading = 'تحليل بعدد المستثمرين';
    protected static ?int $sort = 1;
    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'المستثمرين',
                    'data' => [4344, 5676, 6798, 7890, 8987, 9388, 10343, 10524, 13664, 14345, 15753, 17332],
                    'fill' => 'start',
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
