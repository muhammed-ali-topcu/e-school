<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Models\Grade;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function getPluralLabel(): string
    {
        return __('Subjects');
    }
    public static function getLabel(): ?string
    {
        return __('Subject');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),
                Forms\Components\Select::make('grade_id')
                    ->required()
                    ->label(__('Grade'))
                    ->options(Grade::active()->pluck('name', 'id')),
                Forms\Components\Textarea::make('description')
                    ->label(__('Description'))
                    ->nullable(),
                Forms\Components\Toggle::make('is_active')
                    ->label(__('Active'))
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('grade.name')
                    ->label(__('Grade'))
                    ->searchable(),
                Tables\Columns\BooleanColumn::make('is_active')
                    ->label(__('Active')),
            ])
            ->filters([
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
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
            'index'  => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit'   => Pages\EditSubject::route('/{record}/edit'),
        ];
    }
}
