<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Models\Traits\HasActiveScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * Class Section
 *
 * @property int $id
 * @property string $name
 * @property int $grade_id
 * @property bool $is_active
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Grade $grade
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|Section isActive()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Section onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Section query()
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereGradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Section withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Section withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @method static \Illuminate\Database\Eloquent\Builder|Section active()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WeekProgram> $weekPrograms
 * @property-read int|null $week_programs_count
 * @property string $code
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Section whereLocales(string $column, array $locales)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Lesson> $lessons
 * @property-read int|null $lessons_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @mixin \Eloquent
 */
class Section extends Model
{
    use SoftDeletes;
    use HasActiveScope;
    use HasTranslations;

    protected $table = 'sections';

    protected $casts = [
        'grade_id'  => 'int',
        'is_active' => 'bool'
    ];

    protected $fillable = [
        'name',
        'grade_id',
        'code',
        'is_active'
    ];

    protected $translatable = ['name'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (self $model) {
            $model->setTranslation('name', 'en', $model->grade->getTranslation('name', 'en').' '.$model->code);
            $model->setTranslation('name', 'ar', $model->grade->getTranslation('name', 'ar').' '.$model->code);
            $model->setTranslation('name', 'tr', $model->grade->getTranslation('name', 'tr').' '.$model->code);
        });
        static::updating(function (self $model) {
            $model->setTranslation('name', 'en', $model->grade->getTranslation('name', 'en').' '.$model->code);
            $model->setTranslation('name', 'ar', $model->grade->getTranslation('name', 'ar').' '.$model->code);
            $model->setTranslation('name', 'tr', $model->grade->getTranslation('name', 'tr').' '.$model->code);
        });

    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function subjects(): HasManyThrough
    {
        return $this->hasManyThrough(Subject::class, Grade::class, 'id', 'grade_id', 'id', 'id');
    }


    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function weekPrograms(): HasMany
    {
        return $this->hasMany(WeekProgram::class);
    }

    // public function getNameAttribute($value)
    // {

    //     return $this->grade->name.' '.$this->code;
    // }


    public function lessons():HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function exams():HasMany
    {
        return $this->hasMany(Exam::class);
    }
}
