<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $type
 * @property float|null $total_score
 * @property float|null $pass_score
 * @property int $subject_id
 * @property int $section_id
 * @property int $academic_year_id
 * @property string|null $acted_at
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ExamFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereActedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam wherePassScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereTotalScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereUpdatedAt($value)
 * @property string|null $title
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereTitle($value)
 * @property-read \App\Models\AcademicYear $academicYear
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamPoint> $points
 * @property-read int|null $points_count
 * @property-read \App\Models\Section $section
 * @property-read \App\Models\Subject $subject
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam withoutTrashed()
 * @mixin \Eloquent
 */
class Exam extends Model
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'type',
        'total_score',
        'pass_score',
        'subject_id',
        'section_id',
        'academic_year_id',
        'acted_at',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }
    public function points(): HasMany
    {
        return $this->hasMany(ExamPoint::class);
    }
}
