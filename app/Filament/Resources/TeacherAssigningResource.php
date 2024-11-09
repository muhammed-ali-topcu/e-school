<?php

namespace App\Filament\Resources;


use App\Models\TeacherAssigning;
use App\Filament\Resources\TeacherAssigningResource\Pages;
use App\Helpers\Settings;
use App\Models\Section;
use App\Models\User;
use App\Models\Subject;
use App\Models\WeekProgram;
use App\Rules\UniqueWeekProgramTime;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Table;



class TeacherAssigningResource extends Resource
{
    protected static ?string $model = TeacherAssigning::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralLabel(): string
    {
        return __('Teacher Assignings');
    }
    public static function getLabel(): ?string
    {
        return __('Teacher Assigning');
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
                        return Subject::where('grade_id', $section?->grade_id)->pluck('name', 'id');
                    }),

                Forms\Components\Select::make('user_id')
                    ->label(__('Teacher'))
                    ->required()
                    ->options(function ($get) {
                        return  User::query()->teacher()->pluck('name', 'id');
                    }),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section.name')
                    ->searchable()
                    ->label(__('Section')),

                Tables\Columns\TextColumn::make('subject.name')
                    ->searchable()
                    ->label(__('Subject')),

                Tables\Columns\TextColumn::make('user.name')
                ->searchable()
                    ->label(__('Teacher')),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('section_id')
                    ->label(__('Section'))
                    ->relationship('section', 'name'),

                Tables\Filters\SelectFilter::make('user_id')
                    ->label(__('Teacher'))
                    ->relationship('user', 'name'),

            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->searchable()
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
            'index' => Pages\ListTeacherAssignings::route('/'),
            'create' => Pages\CreateTeacherAssigning::route('/create'),
            'edit' => Pages\EditTeacherAssigning::route('/{record}/edit'),
        ];
    }
}
