<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property string $time
 * @property string $date
 * @property int $section_id
 * @property int $subject_id
 * @property int $academic_year_id
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LessonFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson whereUpdatedAt($value)
 * @property-read \App\Models\AcademicYear $academicYear
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Attendance> $attendances
 * @property-read int|null $attendances_count
 * @property-read \App\Models\Section $section
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @property-read \App\Models\Subject $subject
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Lesson withoutTrashed()
 * @mixin \Eloquent
 */
class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable
        = [
            'title',
            'description',
            'time',
            'date',
            'section_id',
            'subject_id',
            'academic_year_id',
        ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function (self $weekProgram) {
            $weekProgram->academicYear()->associate(AcademicYear::getCurrent());
        });
    }
    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
    public function students(): HasManyThrough{
        return $this->hasManyThrough(Student::class, Attendance::class);
    }
}
