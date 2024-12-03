<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @method static \Database\Factories\AcademicYearFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear query()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear withoutTrashed()
 * @property int $id
 * @property string $name
 * @property string $starts_at
 * @property string $ends_at
 * @property int|null $is_active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AcademicYear whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @mixin \Eloquent
 */
class AcademicYear extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'starts_at',
        'ends_at',
        'is_active'
    ];

    public static function getCurrent(): self
    {
        return self::where('is_active', true)->firstOrFail();
    }

    public function exams():HasMany
    {
        return $this->hasMany(Exam::class);
    }
}
