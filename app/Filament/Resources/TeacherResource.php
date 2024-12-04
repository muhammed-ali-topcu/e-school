<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;

use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralLabel(): string
    {
        return __('Teachers');
    }

    public static function getLabel(): string
    {
        return __('Teacher');
    }
    public static function getNavigationSort(): int
    {
        return 3;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Fieldset::make('User')
                    ->relationship('user')
                    ->label(__('Essential Info'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->required(),

                        TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->required(),

                        TextInput::make('password')
                            ->label(__('Password') . ' (' . __('Leave empty if you don\'t want to change') . ')')
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create'),

                        Forms\Components\Toggle::make('is_active')
                            ->label(__('Active'))
                            ->default(true),

                    ]),
                Forms\Components\TextInput::make('specialty')
                    ->label(__('Specialty'))
                    ->nullable(),

                Forms\Components\TextInput::make('phone')
                    ->mask('9999999999')
     ->placeholder('5xxxxxxxxx')
                    ->label(__('Phone'))
                    ->nullable(),

                Forms\Components\Textarea::make('address')
                    ->label(__('Address'))
                    ->nullable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('Name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label(__('Email'))
                    ->searchable(),
                Tables\Columns\BooleanColumn::make('user.is_active')
                    ->label(__('Active')),
            ])
            ->filters([
                //
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
            'index'  => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit'   => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
