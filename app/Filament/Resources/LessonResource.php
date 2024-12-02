<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Models\Lesson;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralLabel(): string
    {
        return __('Attendances');
    }

    public static function getLabel(): string
    {
        return __('Attendance');
    }
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
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columns(3)
                    ->label(__('Description'))
                    ->columnSpanFull()
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
                    ->afterStateHydrated(function ($component, $state, $record) {
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
                    }),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->limit(30)
                    ->label(__('Title'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('attendances')
                    ->label(__('Attended'))
                    ->formatStateUsing(function ($state, $record) {
                        return $record->attendances()->isPresent()->count() . '/' . $record->attendances()->count();
                    }),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('section_id')
                    ->label(__('Section'))
                    ->relationship('section', 'name'),
                Tables\Filters\SelectFilter::make('subject_id')
                    ->label(__('Subject'))
                    ->relationship('subject', 'name'),

            ])//->filtersLayout(filtersLayout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'view'   => Pages\ViewLesson::route('/{record}'),
        ];
    }

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }


}
