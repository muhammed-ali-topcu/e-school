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
 * @property int $student_id
 * @property int $exam_id
 * @property float|null $score
 * @property string|null $description
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ExamPointFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint whereExamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint whereScore($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint whereUpdatedAt($value)
 * @property-read \App\Models\Exam $exam
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamPoint withoutTrashed()
 * @mixin \Eloquent
 */
class ExamPoint extends Model
{
    /** @use HasFactory<\Database\Factories\ExamPointFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'exam_id',
        'score',
        'description',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }
}
