<?php

namespace App\Filament\Resources\WeekProgramResource\Pages;

use App\Filament\Resources\WeekProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWeekProgram extends EditRecord
{
    protected static string $resource = WeekProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
