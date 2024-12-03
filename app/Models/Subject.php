<?php

namespace App\Models;

use App\Models\Traits\HasActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int $is_active
 * @property string|null $description
 * @property int $grade_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SubjectFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereGradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject withoutTrashed()
 * @property string|null $code
 * @property-read \App\Models\Grade $grade
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCode($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubjectTeacher> $subjectTeachers
 * @property-read int|null $subject_teachers_count
 * @property-read \App\Models\Teacher|null $teacher
 * @method static \Illuminate\Database\Eloquent\Builder|Subject active()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WeekProgram> $weekPrograms
 * @property-read int|null $week_programs_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Lesson> $lessons
 * @property-read int|null $lessons_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @mixin \Eloquent
 */
class Subject extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasActiveScope;


    protected $fillable = ['name', 'description', 'is_active', 'grade_id'];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function weekPrograms(): HasMany
    {
        return $this->hasMany(WeekProgram::class);
    }
    public function lessons():HasMany
    {
        return $this->hasMany(Lesson::class);
    }
    public function exams():HasMany
    {
        return $this->hasMany(Exam::class);
    }



}
