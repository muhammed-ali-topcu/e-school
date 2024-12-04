<?php

namespace App\Filament\Resources\SectionSubjectResource\Pages;

use App\Filament\Resources\SectionSubjectResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSectionSubject extends EditRecord
{
    protected static string $resource = SectionSubjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
