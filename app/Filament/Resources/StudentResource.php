<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Section;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label(__('Active'))
                    ->default(true)
                    ->required(),

                Forms\Components\DatePicker::make('birth_date')
                    ->required(),

                Forms\Components\DatePicker::make('enrollment_date')
                    ->required(),

                Forms\Components\Select::make('grade_id')
                    ->required()
                    ->live()
                    ->relationship('grade', 'name'),
                Forms\Components\Select::make('section_id')
                    ->required()
                    ->options(function ($get) {
                        return Section::where('grade_id', $get('grade_id'))->pluck('name', 'id');
                    }),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('grade.name')->searchable(),
                Tables\Columns\TextColumn::make('section.name')->searchable(),
                Tables\Columns\BooleanColumn::make('is_active'),
            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index'  => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit'   => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}