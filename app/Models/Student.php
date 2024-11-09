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
 * @property string $name
 * @property int $grade_id
 * @property int $section_id
 * @property int $is_active
 * @property string $birth_date
 * @property string $enrollment_date
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\StudentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEnrollDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereGradeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @property-read \App\Models\Grade $grade
 * @property-read \App\Models\Section $section
 * @method static \Illuminate\Database\Eloquent\Builder|Student active()
 * @method static \Illuminate\Database\Eloquent\Builder|Student onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereEnrollmentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Student withoutTrashed()
 * @property string|null $phone
 * @property string $guardian_name
 * @property string $guardian_phone
 * @property string|null $address
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereGuardianName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereGuardianPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student wherePhone($value)
 * @mixin \Eloquent
 */
class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasActiveScope;

    protected $fillable = [
        'name',
        'grade_id',
        'section_id',
        'is_active',
        'birth_date',
        'enrollment_date',
        'guardian_name',
        'guardian_phone',
        'phone',
        'address',

    ];

    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
