<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use phpDocumentor\Reflection\PseudoTypes\List_;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('section_id')
                    ->label(__('Section'))
                    ->disabled()
                    ->relationship('section', 'name')
                    ->live()
                    ->required(),
                Forms\Components\Select::make('subject_id')
                    ->disabled()
                    ->label(__('Subject'))
                    ->relationship('subject', 'name')
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->label(__('Lesson Title'))
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->label(__('Description'))
                    ->maxLength(255),
                Forms\Components\DatePicker::make('date')
                    ->label(__('Date'))
                    ->required(),
                Forms\Components\TimePicker::make('time')
                    ->label(__('Time'))
                    ->required()
                    ->seconds(false)
                    ->format('H:i'),

                Forms\Components\CheckboxList::make('attended_student_ids')
                    ->label(__('Students'))
                    ->afterStateHydrated(function ($component, $state,  $record) {
                        if (!filled($state)) {
                            $attended_student_ids = $record?->attendances()->isPresent()->pluck('student_id')->toArray() ?? [];
                            $component->state($attended_student_ids);
                        }
                    })
                    ->bulkToggleable()
                    ->options(function (Forms\Get $get) {
                        if (!empty($get('section_id'))) {
                            return Student::where('section_id', $get('section_id'))
                                ->active()
                                ->get()
                                ->pluck('name', 'id');
                        }
                    })


                ,

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('section.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('academicYear.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index'  => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create/'),
            'edit'   => Pages\EditLesson::route('/{record}/edit'),
        ];
    }




}
