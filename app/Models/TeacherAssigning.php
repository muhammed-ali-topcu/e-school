<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int|null $teacher_id
 * @property int $subject_id
 * @property int $section_id
 * @property int $user_id
 * @property int $academic_year_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\AcademicYear $academicYear
 * @property-read \App\Models\Section $section
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\Teacher|null $teacher
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning query()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning whereAcademicYearId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|TeacherAssigning withoutTrashed()
 * @mixin \Eloquent
 */
class TeacherAssigning extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected static function boot()
    {
        parent::boot();
        self::creating(function (self $model) {
            $model->academicYear()->associate(AcademicYear::getCurrent());
        });
    }

    protected $fillable = [
        'teacher_id',
        'section_id',
        'subject_id',
        'academic_year_id',
        'user_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
