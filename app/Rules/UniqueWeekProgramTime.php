<?php

namespace App\Rules;

use App\Models\WeekProgram;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueWeekProgramTime implements ValidationRule
{
    protected $sectionId;
    protected $dayIndex;
    protected $ignoreId;

    public function __construct($sectionId, $dayIndex, $ignoreId = null)
    {
        $this->sectionId = $sectionId;
        $this->dayIndex = $dayIndex;
        $this->ignoreId = $ignoreId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = WeekProgram::where('section_id', $this->sectionId)
            ->where('day_index', $this->dayIndex)
            ->where('start_time', $value);

        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        $exists = $query->exists();

        if ($exists) {
            $fail(__('There is already a program scheduled at this time for the selected section and day.'));
        }
    }
}
