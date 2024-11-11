<?php

namespace App\Filament\Resources\GradeResource\Pages;

use App\Filament\Resources\GradeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;


class CreateGrade extends CreateRecord
{

    use CreateRecord\Concerns\Translatable;

    protected static string $resource = GradeResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
