<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubjectResource\Pages;
use App\Filament\Resources\SubjectResource\RelationManagers;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                    ->required(),
                Forms\Components\Select::make('grade_id')
                    ->required()
                    ->label(__('Grade'))
                    ->options(Grade::active()->pluck('name', 'id')),
                Forms\Components\Textarea::make('description')->nullable(),
                Forms\Components\Toggle::make('is_active')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('grade.name')->searchable(),
                Tables\Columns\TextColumn::make('teacher.name')->searchable(),
                Tables\Columns\BooleanColumn::make('is_active'),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('assign_teacher')
                    ->form(function ($record) {
                        return [
                            Forms\Components\Select::make('teacher_id')
                                ->options(Teacher::active()->pluck('name', 'id'))
                                ->default($record->teacher?->id)
                                ->label(__('Teacher'))
                                ->required()
                        ];
                    })
                    ->action(function (Subject $record, $data) {
                        $record->assignToTeacher(Teacher::findOrFail($data['teacher_id']));
                        Notification::make()
                            ->title(__('Teacher assigned successfully!'))
                            ->success()
                            ->send();
                        return true;
                    }),

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
            'index'  => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit'   => Pages\EditSubject::route('/{record}/edit'),
        ];
    }


}
