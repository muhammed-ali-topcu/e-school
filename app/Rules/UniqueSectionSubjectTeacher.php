<?php

namespace App\Rules;

use App\Models\TeacherAssigning;
use App\Models\WeekProgram;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueSectionSubjectTeacher implements ValidationRule
{
    protected $sectionId;
    protected $subjectId;
    protected $ignoreId;

    public function __construct($sectionId, $subjectId, $ignoreId = null)
    {
        $this->sectionId = $sectionId;
        $this->subjectId = $subjectId;
        $this->ignoreId = $ignoreId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = TeacherAssigning::where('section_id', $this->sectionId)
            ->where('subject_id', $this->subjectId);

        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        $exists = $query->exists();

        if ($exists) {
            $fail(__('There is already a teacher assigned to this section and subject.'));
        }
    }
}
