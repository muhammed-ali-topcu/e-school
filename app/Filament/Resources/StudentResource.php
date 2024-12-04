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

    public static function getPluralLabel(): string
    {
        return __('Students');
    }

    public static function getLabel(): string
    {
        return __('Student');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),

                Forms\Components\Toggle::make('is_active')
                    ->label(__('Active'))
                    ->default(true)
                    ->required(),

                Forms\Components\Select::make('grade_id')
                    ->label(__('Grade'))
                    ->required()
                    ->live()
                    ->relationship('grade', 'name'),

                Forms\Components\Select::make('section_id')
                    ->label(__('Section'))
                    ->required()
                    ->options(function ($get) {
                        return Section::where('grade_id', $get('grade_id'))->pluck('name', 'id');
                    }),

                Forms\Components\DatePicker::make('birth_date')
                    ->label(__('Birth Date'))
                    ->nullable(),

                Forms\Components\DatePicker::make('enrollment_date')
                    ->label(__('Enrollment Date'))
                    ->nullable(),

                Forms\Components\TextInput::make('phone')
                    ->label(__('Phone'))
                    ->mask('9999999999')
                    ->placeholder('5xxxxxxxxx')
                    ->nullable(),

                Forms\Components\TextInput::make('guardian_name')
                    ->label(__('Guardian Name'))
                    ->nullable(),

                Forms\Components\TextInput::make('guardian_phone')
                    ->label(__('Guardian Phone'))
                    ->mask('9999999999')
                    ->placeholder('5xxxxxxxxx')
                    ->nullable(),

                Forms\Components\Textarea::make('address')
                    ->rows(3)
                    ->label(__('Address'))
                    ->nullable(),

                Forms\Components\Textarea::make('note')
                    ->rows(5)
                    ->columnSpanFull()
                    ->label(__('Note'))
                    ->nullable(),

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
                Tables\Columns\TextColumn::make('section.name')
                    ->label(__('Section'))
                    ->searchable(),
                Tables\Columns\BooleanColumn::make('is_active')
                    ->label(__('Active')),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('section_id')
                    ->label(__('Section'))
                    ->relationship('section', 'name'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index'  => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit'   => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
