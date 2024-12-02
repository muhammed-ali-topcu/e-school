<?php

namespace App\Filament\Resources\LessonResource\Pages;

use App\Filament\Resources\LessonResource;
use App\Filament\Resources\SectionResource;
use App\Models\Attendance;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;


class CreateLesson extends CreateRecord
{
    protected static string $resource = LessonResource::class;

    public function mount(): void
    {
        parent::mount();

        $sectionId = request()->query('section_id');
        $subjectId = request()->query('subject_id');

        $this->form->fill([
            'section_id' => $sectionId,
            'subject_id' => $subjectId,
            'date'       => now()->format('Y-m-d'),
        ]);
    }

    public function getTitle(): string|Htmlable
    {
        return __('Take Attendance');
    }

    public function afterCreate(): void
    {
        foreach ($this->record->section->students as $student) {
            Attendance::updateOrCreate([
                'lesson_id'  => $this->record->id,
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
