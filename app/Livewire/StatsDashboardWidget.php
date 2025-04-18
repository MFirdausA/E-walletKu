<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\User;
use App\Models\Walletallet;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsDashboardWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::where('id', '<>', 1)->count()),
            Stat::make('Total Wallet', Wallet::count()),
            Stat::make('Total Category', Category::count()),
        ];
    }
}
