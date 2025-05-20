<?php

namespace App\Filament\Widgets;

use Flowframe\Trend\Trend;
use App\Models\Transaction;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class TransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Transactions (30 Days)';
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = Trend::query(Transaction::where('status', 'success'))
                ->between(
                    start: now()->subDays(30),
                    end: now()->endOfMonth()
                )
                ->perDay()
                ->sum('total');

        return [
            'datasets' => [
                [
                    'label' => 'Total Transactions',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate)->toArray(),
                    'fill' => true,
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => \Carbon\Carbon::parse($value->date)->format('d M'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}