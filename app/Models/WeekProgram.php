<?php

namespace App\Models;

use App\Models\Traits\BelongsToThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $day
 * @property string $start_time
 * @property string|null $end_time
 * @property int $section_id
 * @property int $subject_id
 * @property string|null $deleted_at
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WeekProgramFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram query()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram whereUpdatedAt($value)
 * @property-read \App\Models\Section $section
 * @property-read \App\Models\Subject $subject
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram withoutTrashed()
 * @property int $day_index
 * @property-read \App\Models\Grade|null $grade
 * @method static \Illuminate\Database\Eloquent\Builder|WeekProgram whereDayIndex($value)
 * @mixin \Eloquent
 */
class WeekProgram extends Model
{
    use HasFactory;
    use SoftDeletes;
    use BelongsToThrough;

    protected $fillable = [
        'day',
        'start_time',
        'end_time',
        'section_id',
        'subject_id',
        'is_active',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class)->join('sections', 'sections.grade_id', '=', 'grades.id')
            ->where('sections.id', '=', $this->section_id);
    }


    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
