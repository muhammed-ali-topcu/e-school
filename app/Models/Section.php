<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @mixin \Eloquent
 */
class Section extends Model
{
	use SoftDeletes;
	protected $table = 'sections';

	protected $casts = [
		'grade_id' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'grade_id',
		'is_active'
	];


    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }
	public function grade()
	{
		return $this->belongsTo(Grade::class);
	}
}
