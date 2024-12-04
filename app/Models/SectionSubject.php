<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 *
 * @property int $id
 * @property int $section_id
 * @property int $subject_id
 * @property int|null $teacher_id
 * @property int $academic_year_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SectionSubjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SectionSubject withoutTrashed()
 * @mixin \Eloquent
 */
class SectionSubject extends Model
{
    /** @use HasFactory<\Database\Factories\SectionSubjectFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'section_id',
        'subject_id',
        'teacher_id',
        'academic_year_id',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function (self $sectionSubject) {
            $sectionSubject->academicYear()->associate(AcademicYear::getCurrent());
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

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }


}
