<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionSubjectResource\Pages;
use App\Filament\Resources\SectionSubjectResource\RelationManagers;
use App\Models\SectionSubject;
use App\Models\Teacher;
use App\Rules\UniqueSectionSubject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SectionSubjectResource extends Resource
{
    protected static ?string $model = SectionSubject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function getPluralLabel(): string
    {
        return __('Subject Assignments');
    }

    public static function getLabel(): string
    {
        return __('Subject Assignment');
    }
    public static function getNavigationSort(): int
    {
        return 6;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('section_id')
                    ->label(__('Section'))
                    ->relationship('section', 'name')
                    ->disabledOn('edit')
                    ->required(),

                Forms\Components\Select::make('subject_id')
                    ->label(__('Subject'))
                    ->relationship('subject', 'name')
                    ->disabledOn('edit')
                    ->required()
                    ->rules([
                        fn(Get $get): UniqueSectionSubject => new UniqueSectionSubject(
                            $get('section_id'),
                            $get('subject_id'),
                            $get('id') // This will be null for new records and set for existing ones
                        ),
                    ]),
                Forms\Components\Select::make('teacher_id')
                    ->label(__('Teacher'))
                    ->nullable()
                    ->options(Teacher::query()->get()->pluck('user.name', 'id')),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('Is Active'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section.name')
                    ->label(__('Section')),
                Tables\Columns\TextColumn::make('subject.name')
                    ->label(__('Subject')),
                Tables\Columns\TextColumn::make('teacher.user.name')
                    ->label(__('Teacher')),
                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('Is Active'))
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('section_id')
                    ->label(__('Section'))
                    ->relationship('section', 'name'),

                Tables\Filters\SelectFilter::make('subject_id')
                    ->label(__('Subject'))
                    ->relationship('subject', 'name'),

                Tables\Filters\SelectFilter::make('teacher_id')
                    ->label(__('Teacher'))
                    ->options(Teacher::query()->get()->pluck('user.name', 'id')),
            ])->filtersLayout(Tables\Enums\FiltersLayout::AboveContent)
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
            'index'  => Pages\ListSectionSubjects::route('/'),
            'create' => Pages\CreateSectionSubject::route('/create'),
            'edit'   => Pages\EditSectionSubject::route('/{record}/edit'),
        ];
    }
}
