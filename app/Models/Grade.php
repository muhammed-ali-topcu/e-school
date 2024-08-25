<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @mixin \Eloquent
 */
class Grade extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'is_active', 'sequence'
    ];

    protected static function boot()
    {
        parent::boot();
        self::created(function (self $grade) {
            $grade->sections()->save(new Section(['name' => 'A']));
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class);
    }


}
