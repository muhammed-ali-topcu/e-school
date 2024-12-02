<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use App\Filament\Resources\SectionResource;
use App\Models\Attendance;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLesson extends EditRecord
{
    protected static string $resource = LessonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function afterSave(): void
    {
        foreach ($this->record->section->students as $student) {
            Attendance::updateOrCreate([
                'lesson_id' => $this->record->id,
                'student_id' => $student->id,
            ], [
                'is_present' => in_array($student->id, $this->data['attended_student_ids']),
            ]);
        }
    }

    protected function getRedirectUrl(): string
    {
        return SectionResource::getUrl('view', ['record' => $this->form->getRecord()->section_id]);
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return __('Attendance saved successfully');
    }

}
