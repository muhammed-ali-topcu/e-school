<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use App\Filament\Resources\SectionResource;
use App\Filament\Resources\StudentResource;
use App\Models\Section;
use Filament\Actions;
use Filament\Infolists\Components\Actions\Action;

use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables;
use Filament\Infolists\Components\RepeatableEntry;

class ViewLesson extends ViewRecord
{
    protected static string $resource = LessonResource::class;


    public function getTitle():string
    {
        return __('Attendance Details');

    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }


}
