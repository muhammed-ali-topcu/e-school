<?php

namespace App\Models;

use App\Models\Traits\HasActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int $subject_id
 * @property int $teacher_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\Teacher $teacher
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher active()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectTeacher withoutTrashed()
 * @mixin \Eloquent
 */
class SubjectTeacher extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasActiveScope;

    protected $table = 'subject_teacher';

    protected $fillable = [
        'subject_id',
        'teacher_id',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
