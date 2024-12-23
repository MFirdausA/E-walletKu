<?php

namespace App\Livewire;

use App\Models\category;
use App\Models\User;
use App\Models\wallet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboardWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::where('id', '<>', 1)->count()),
            Stat::make('Total Wallet', wallet::count()),
            Stat::make('Total Category', category::count()),
        ];
    }
}
