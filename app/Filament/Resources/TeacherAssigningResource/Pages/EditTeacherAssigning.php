<?php

namespace App\Filament\Resources\TeacherAssigningResource\Pages;

use App\Filament\Resources\TeacherAssigningResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeacherAssigning extends EditRecord
{
    protected static string $resource = TeacherAssigningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
