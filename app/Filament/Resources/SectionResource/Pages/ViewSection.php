<?php

namespace App\Filament\Resources\SectionResource\Pages;

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

class ViewSection extends ViewRecord
{
    protected static string $resource = SectionResource::class;


    public static function getNavigationLabel(): string
    {
        return __('View Section');
    }

    public function getTitle(): string
    {
        return $this->record->name;
    }


    public function infolist(Infolist $infolist): Infolist
    {

        return $infolist->schema([
            Tabs::make(__('section'))->tabs([
//                Tab::make(__('Info'))->schema([
//                    TextEntry::make('name')->label(__('Name')),
//                ]),

                Tab::make(__('Subjects'))->schema([
                    RepeatableEntry::make('grade.subjects')
                        ->hiddenLabel()
                        ->schema([
                            Grid::make()->schema([
                                TextEntry::make('name')->hiddenLabel(),
                                TextEntry::make('id')
                                    ->hiddenLabel()
                                    ->formatStateUsing(fn() => __('Take Attendance'))
                                    ->url(function ($record) {
                                        return LessonResource::getUrl('create', ['section_id' => $this->record->id, 'subject_id' => $record->id]);
                                    })
                                    ->color('success')
                            ]),
                        ])
                        ->columnSpanFull()
                    ,
                ]),

                Tab::make(__('Students'))->schema([
                    RepeatableEntry::make('students')
                        ->hiddenLabel()
                        ->schema([
                            TextEntry::make('name')->hiddenLabel(),
                        ])
                        ->columnSpanFull(),
                ]),

            ])->columnSpanFull()
        ]);

    }

}
