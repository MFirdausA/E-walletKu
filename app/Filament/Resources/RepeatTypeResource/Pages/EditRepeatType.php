<?php

namespace App\Filament\Resources\RepeatTypeResource\Pages;

use App\Filament\Resources\RepeatTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRepeatType extends EditRecord
{
    protected static string $resource = RepeatTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
