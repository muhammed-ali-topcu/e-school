<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeekProgramResource\Pages;
use App\Helpers\Settings;
use App\Models\Section;
use App\Models\Subject;
use App\Models\WeekProgram;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;

class WeekProgramResource extends Resource
{
    protected static ?string $model          = WeekProgram::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function getPluralLabel(): string
    {
        return __('Week Programs');
    }

    public static function getLabel(): string
    {
        return __('Week Program');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('section_id')
                    ->label(__('Section'))
                    ->required()
                    ->live()
                    ->relationship('section', 'name'),

                Forms\Components\Select::make('subject_id')
                    ->label(__('Subject'))
                    ->required()
                    ->options(function ($get) {
                        $section = Section::find($get('section_id'));
                        return Subject::where('grade_id', $section->grade_id)->pluck('name', 'id');
                    }),

                Forms\Components\Select::make('day_index')
                    ->options(Settings::getStudyDays())
                    ->required()
                    ->label(__('Day')),

                Forms\Components\TimePicker::make('start_time')
                    ->required()
                    ->label(__('Time')),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section.name')
                    ->searchable()
                    ->label(__('Section')),

                Tables\Columns\TextColumn::make('day_index')
                    ->formatStateUsing(function (WeekProgram $record): string {
                        return $record->day_name;
                    })
                    ->sortable()
                    ->label('Day'),

                Tables\Columns\TextColumn::make('start_time')
                    ->formatStateUsing(function (WeekProgram $record): string {
                        return Carbon::parse($record->start_time)->format('H:i');
                    })
                    ->sortable()
                    ->searchable()
                    ->label('Time'),

                Tables\Columns\TextColumn::make('subject.name')
                    ->searchable()
                    ->label(__('Subject')),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('section_id')
                    ->label(__('Section'))
                    ->relationship('section', 'name'),
                Tables\Filters\SelectFilter::make('day_index')
                    ->options(Settings::getStudyDays())
                    ->label(__('Day')),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListWeekPrograms::route('/'),
            'create' => Pages\CreateWeekProgram::route('/create'),
            'edit'   => Pages\EditWeekProgram::route('/{record}/edit'),
        ];
    }
}
