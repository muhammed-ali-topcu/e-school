<?php

namespace App\Models;

use App\Models\Traits\HasActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int $sequence
 * @property int $is_active
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\GradeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Grade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade query()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereSequence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Section> $sections
 * @property-read int|null $sections_count
 * @method static \Illuminate\Database\Eloquent\Builder|Grade active()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Grade withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @property-read mixed $translations
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereJsonContainsLocale(string $column, string $locale, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereJsonContainsLocales(string $column, array $locales, ?mixed $value, string $operand = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereLocale(string $column, string $locale)
 * @method static \Illuminate\Database\Eloquent\Builder|Grade whereLocales(string $column, array $locales)
 * @mixin \Eloquent
 */
class Grade extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasActiveScope;
    use HasTranslations;

    protected $fillable = [
        'name',
        'is_active',
        'sequence'
    ];
    public $translatable = ['name'];

    protected static function boot()
    {
        parent::boot();
        self::created(function (self $grade) {
            $grade->sections()->save(new Section(['code' =>  "A"]));
        });
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }

    public static function getBySequence(int $sequence): self
    {
        return self::where('sequence', $sequence)->firstOrFail();
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
