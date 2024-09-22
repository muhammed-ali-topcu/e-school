<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WeekProgramResource\Pages;
use App\Filament\Resources\WeekProgramResource\RelationManagers;
use App\Models\WeekProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WeekProgramResource extends Resource
{
    protected static ?string $model = WeekProgram::class;

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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('grade.name')
//                    ->default(function ($record) {
//                        return $record->section->grade->name;
//                    })
                    ->label(__('Grade')),

                Tables\Columns\TextColumn::make('section.name')
                    ->searchable()
                    ->label(__('Section')),

                Tables\Columns\TextColumn::make('subject.name')
                    ->searchable()
                    ->label(__('Subject')),

                Tables\Columns\TextColumn::make('day')
                    ->searchable()
                    ->label('Day'),

                Tables\Columns\TextColumn::make('start_time')
                    ->searchable()
                    ->label('Time'),



            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
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
