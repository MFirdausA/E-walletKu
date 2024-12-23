<?php

namespace App\Filament\Resources\RepeatTypeResource\Pages;

use App\Filament\Resources\RepeatTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRepeatTypes extends ListRecords
{
    protected static string $resource = RepeatTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
