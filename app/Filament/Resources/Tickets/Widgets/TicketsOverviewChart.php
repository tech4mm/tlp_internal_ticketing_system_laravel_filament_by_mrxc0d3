<?php

namespace App\Filament\Resources\Tickets\Widgets;

use App\Models\Ticket;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TicketsOverviewChart extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Open', Ticket::where('status', 'open')->count())
                ->icon('heroicon-o-folder-open')
                ->color('warning'),

            Stat::make('In Progress', Ticket::where('status', 'in_progress')->count())
                ->icon('heroicon-o-clock')
                ->color('info'),

            Stat::make('Resolved', Ticket::where('status', 'resolved')->count())
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            Stat::make('Closed', Ticket::where('status', 'closed')->count())
                ->icon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
